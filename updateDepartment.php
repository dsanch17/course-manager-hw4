<?php
/**
 * Homework4
 * Group3_HW04.zip
 * Dallas Sanchez
 * Matthew Higgins
 */

require_once('database.php');

$departmentID = filter_input(INPUT_POST,'departmentID');
$departmentName = filter_input(INPUT_POST,'departmentName');

//$updateInstrument = "UPDATE Instruments SET instrumentName=:name, listPrice=:price, categoryID=:categoryID WHERE instrumentID=:instrumentID";
if ($departmentName != null && strlen($departmentName) > 0) {

    $updateDepartment = "UPDATE department SET departmentName = :departmentName WHERE departmentID = :departmentID";
    $updateStatement = $db->prepare($updateDepartment);
    $updateStatement->bindParam('departmentName', $departmentName);
    $updateStatement->bindParam('departmentID', $departmentID);

    $updateStatement->execute();
}


header("Location: department_list.php");
die();
?>