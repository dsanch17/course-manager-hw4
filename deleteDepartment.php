<?php


require_once('database.php');

$departmentID = filter_input(INPUT_POST,'departmentID');

$deleteDepartment = "DELETE FROM department WHERE departmentID = :departmentID";
$deleteStatement = $db->prepare($deleteDepartment);
$deleteStatement->bindParam('departmentID', $departmentID);

$deleteStatement->execute();


header("Location: department_list.php");
die();
?>