<?php


require_once('database.php');

$departmentID = filter_input(INPUT_POST,'departmentID');

//$deleteInstrument = "DELETE FROM Instruments WHERE instrumentID = :instrumentID";


$deleteDepartment = "DELETE FROM department WHERE departmentID = :departmentID";
$deleteStatement = $db->prepare($deleteDepartment);
$deleteStatement->bindParam('departmentID', $departmentID);

$deleteStatement->execute();


header("Location: department_list.php");
die();
?>