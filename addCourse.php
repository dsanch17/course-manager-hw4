<?php
require_once('database.php');

$departmentID = filter_input(INPUT_POST,'departmentID');
$code = filter_input(INPUT_POST,'code');
$credits = filter_input(INPUT_POST,'credits');
$title = filter_input(INPUT_POST,'title');
$description = filter_input(INPUT_POST,'description');


$addCourse = "INSERT INTO courses (crs_code, crs_title, crs_credits, dep_id, crs_description)
              VALUES (:code, :title, :credits, :depID, :description);";



$addStatement = $db->prepare($addCourse);
$addStatement->bindParam('code', $code);
$addStatement->bindParam('title', $title);
$addStatement->bindParam('credits', $credits);
$addStatement->bindParam('depID', $departmentID);
$addStatement->bindParam('description', $description);

$addStatement->execute();



header("Location: index.php?departmentID=$departmentID");
die();
?>