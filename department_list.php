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
    <title>Courses Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<main>
    <h1 style="color: black">Courses Manager</h1>
    <hr>
    <h1>Department List</h1>

    <table>
        <tr>
            <th>Name</th>
            <th colspan="2"></th>
        </tr>

        <?php foreach ($departments as $department) :?>
        <tr>
            <td>
                <?php echo $department['departmentName'];?>
            </td>

            <td>
                <form method="post" action="deleteDepartment.php">
                    <input type="hidden" name="departmentID" value="<?php echo $department['departmentID']; ?>">
                    <button type="submit" value="delete" name="delete">Delete</button>
                </form>
            </td>

            <td>
                <form method="post" action="department_update_form.php">
                    <input type="hidden" name="departmentID" value="<?php echo $department['departmentID']; ?>">
                    <button type="submit" value="<?php echo $department['departmentName'];?>" name="update">Update</button>
                </form>
            </td>

        </tr>
        <?php endforeach; ?>
    </table> <br>

    <h2>Add Department</h2>
    <form method="post" action="addDepartment.php">
        <label>Name:</label><input type="text" name="departmentName" required><button type="submit" value="Add">Add</button>
    </form>

    <p>
        <a href="index.php">
            List Courses
        </a>
    </p>


</main>
<footer>
    <hr>
</footer>
</body>
</html>

