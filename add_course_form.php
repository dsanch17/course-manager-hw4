<?php

/**
 * Homework4
 * Group3_HW04.zip
 * Dallas Sanchez
 * Matthew Higgins
 */

require_once('database.php');

// Get all departments
$queryAllDepartments = 'SELECT * FROM department ORDER BY departmentID';
$statement1 = $db->prepare($queryAllDepartments);
$statement1->execute();
$departments = $statement1->fetchAll();
$statement1->closeCursor();


?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title>Add Course</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<main>
    <h1 style="color: black">University Courses Manager</h1>
    <hr>
    <h1>Add Course</h1>

    <form method="post" action="addCourse.php">

        <label>Department:</label>
        <select name="departmentID">
            <?php foreach ($departments as $department) : ?>
            <option value="<?php echo $department['departmentID']; ?>"><?php echo $department['departmentName'] . $department['departmentID']; ?>
            <?php endforeach; ?>
        </select>
        <br>

        <label>Code: </label><input type="number" name="code" required>
        <br>
        <label>Title: </label><input type="text" name="title" required>
        <br>
        <label>Credits :</label><input type="number" name="credits" step="1" required>
        <br><br>
        <label>Description: </label><textarea name="description" rows="5" cols="40" required placeholder="Add description here..."></textarea>
        <br>
        <button type="submit" value="Add Course">Add Course</button>
    </form>

    <p>
        <a href="index.php">
            View Course List
        </a>
    </p>