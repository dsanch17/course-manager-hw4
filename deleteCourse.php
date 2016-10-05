<?php

/**
 * Homework4
 * Group3_HW04.zip
 * Dallas Sanchez
 * Matthew Higgins
 */

require_once('database.php');

$courseID = filter_input(INPUT_POST,'crs_ID');
$departmentID = filter_input(INPUT_POST, 'dep_id');

//crs_ID

$deleteCourse = "DELETE FROM courses WHERE crs_ID = :cID";
$deleteStatement = $db->prepare($deleteCourse);
$deleteStatement->bindParam('cID', $courseID);

$deleteStatement->execute();


header("Location: index.php?departmentID=$departmentID");
die();
?>