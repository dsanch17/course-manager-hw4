<?php

/**
 * Homework4
 * Group3_HW04.zip
 * Dallas Sanchez
 * Matthew Higgins
 */

require_once('database.php');

$departmentName = filter_input(INPUT_POST,'departmentName');
//print_r($departmentName);
if ($departmentName != null && strlen($departmentName) > 0) {
    //print_r($departmentName);


    $addDepartment = "INSERT INTO department(departmentName) VALUES (:departmentName);";
    $addStatement = $db->prepare($addDepartment);
    $addStatement->bindParam('departmentName', $departmentName);

    $addStatement->execute();

}

header("Location: department_list.php");
die();
?>