<?php

/**
 * Homework4
 * Group3_HW04.zip
 * Dallas Sanchez
 * Matthew Higgins
 */

require_once('database.php');



$departmentID = filter_input(INPUT_POST,'departmentID');
$code = filter_input(INPUT_POST,'code');
$credits = filter_input(INPUT_POST,'credits');
$title = filter_input(INPUT_POST,'title');
$description = filter_input(INPUT_POST,'description');
$courseID = filter_input(INPUT_POST,'courseID');


//$updateInstrument = "UPDATE Instruments SET instrumentName=:name, listPrice=:price, categoryID=:categoryID WHERE instrumentID=:instrumentID";

$updateCourse = "UPDATE courses SET crs_code =:code, crs_title=:title, crs_credits=:credits, dep_id=:departmentID, crs_description=:description WHERE crs_ID = :courseID";
$updateStatement = $db->prepare($updateCourse);

$updateStatement->bindParam('code', $code);
$updateStatement->bindParam('title', $title);
$updateStatement->bindParam('credits', $credits);
$updateStatement->bindParam('departmentID', $departmentID);
$updateStatement->bindParam('description', $description);
$updateStatement->bindParam('courseID', $courseID);

$updateStatement->execute();


header("Location: student_home.php?departmentID=$departmentID");
die();
?>