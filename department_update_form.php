<?php
/**
 * Created by PhpStorm.
 * User: Dallas
 * Date: 9/29/16
 * Time: 7:03 PM
 */

$departmentID = filter_input(INPUT_POST,'departmentID');

$oldName = filter_input(INPUT_POST,'update');

?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title>Update Department</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<main>
    <h1 style="color: black">University Courses Manager</h1>
    <hr>
    <h1>Update Department</h1>

    <form method="post" action="updateDepartment.php">
        <label>Department Name:</label><input type="text" name="departmentName" value="<?php echo $oldName; ?>" required>
        <br><br>
        <input type="hidden" value="<?php echo $departmentID; ?>" name="departmentID">
        <button type="submit" value="Update Department">Update Department</button>
    </form>

    <p>
        <a href="department_list.php">
            View Department List
        </a>
    </p>

</main>
<footer>
    <hr>
</footer>
</body>
</html>