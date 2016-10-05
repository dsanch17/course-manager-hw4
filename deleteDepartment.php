<?php

/**
 * Homework4
 * Group3_HW04.zip
 * Dallas Sanchez
 * Matthew Higgins
 */

require_once('database.php');

$departmentID = filter_input(INPUT_POST,'departmentID');

$deleteDepartment = "DELETE FROM department WHERE departmentID = :departmentID";
$deleteStatement = $db->prepare($deleteDepartment);
$deleteStatement->bindParam('departmentID', $departmentID);

$deleteStatement->execute();


header("Location: department_list.php");
die();
?>