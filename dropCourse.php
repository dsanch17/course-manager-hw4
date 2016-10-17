<?php

/**
 * ITIS 3105 Midterm
 * Dallas Sanchez
 */

require_once('database.php');

$courseID = filter_input(INPUT_POST,'crs_ID');

$dropCourse = "DELETE FROM reg_courses WHERE crs_ID = :cID";
$dropStatement = $db->prepare($dropCourse);
$dropStatement->bindParam('cID', $courseID);

$dropStatement->execute();


header("Location: ./registered_Courses.php");
die();
?>