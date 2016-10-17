<?php

/**
 * ITIS 3105 Midterm
 * Dallas Sanchez
 */

require_once('database.php');

$courseID = filter_input(INPUT_POST,'crs_ID');

$registerCourse = "INSERT INTO reg_courses (crs_id) VALUES (:crs_id);";

$registerStatement = $db->prepare($registerCourse);
$registerStatement->bindParam('crs_id', $courseID);


$registerStatement->execute();



header("Location: ./registered_Courses.php");
die();
?>