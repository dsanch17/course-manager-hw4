<?php
/**
 * ITIS 3105 Midterm
 * Dallas Sanchez
 */

require_once('database.php');


// Get all departments
$queryAllDepartments = 'SELECT * FROM department ORDER BY departmentID';
$statement1 = $db->prepare($queryAllDepartments);
$statement1->execute();
$departments = $statement1->fetchAll();
$statement1->closeCursor();



// Get department ID from get, or the first in the database
$departmentID = filter_input(INPUT_GET, 'departmentID', FILTER_VALIDATE_INT);
if ($departmentID == NULL || $departmentID == FALSE) {
    $departmentID = $departments[0][0];
}
    
// Get name for selected department
$queryDepartment = 'SELECT departmentName FROM department  WHERE departmentID = :departmentID';
$statement2 = $db->prepare($queryDepartment);
$statement2->bindValue(':departmentID', $departmentID);
$statement2->execute();
$departmentArray = $statement2->fetch();
$department_name = $departmentArray['departmentName'];
$statement2->closeCursor();



// Get courses for selected department                                  ORDERING BY CHAR FIELD
$queryCourses = 'SELECT * FROM courses WHERE dep_id = :departmentID ORDER BY crs_code';
$statement3 = $db->prepare($queryCourses);
$statement3->bindValue(':departmentID', $departmentID);
$statement3->execute();
$courses = $statement3->fetchAll();
$statement3->closeCursor();

// Get all registered courses
$queryRegCourses = 'SELECT crs_ID FROM reg_courses';
$statement4 = $db->prepare($queryRegCourses);
$statement4->execute();
$registrationIDs = $statement4->fetchAll();
$statement4->closeCursor();

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
    <h1 style="color: black">University Courses Manager</h1>
    <hr>
    <h1>Courses List</h1>
    <aside>
        <!-- display a list of departments -->
        <h2>Departments</h2>
        <nav>
        <ul>
            <?php foreach ($departments as $department) : ?>
            <li>
                <a href="?departmentID=<?php echo $department['departmentID']; ?>">
                    <?php echo $department['departmentName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>           
    </aside>

    <section>
        <!-- display a table of products -->
        <h2><?php echo $department_name; ?></h2>

        <table>
            <tr>
                <th>Code</th>
                <th>Title</th>
                <th>Credits</th>
                <th>Description</th>
                <th></th>
            </tr>

            <?php foreach ($courses as $course) : ?>
            <tr>
                <td><?php echo $course['crs_code']; ?></td>
                <td><?php echo $course['crs_title']; ?></td>
                <td><?php echo $course['crs_credits']; ?></td>
                <td><?php echo $course['crs_description']; ?></td>

                <td>
                    <form method="post" action="registerCourse.php">
                        <input type="hidden" name="crs_ID" value="<?php echo $course['crs_ID']; ?>">

                        <button type="submit" value="register" name="register" <?php
                        foreach ($registrationIDs as $regID) {
                            if ($course['crs_ID'] == $regID[0]) {
                            echo " disabled=\"disabled\"";
                            }
                        }

                        ?> >Register</button>
                    </form>
                </td>


            </tr>
            <?php endforeach; ?>            
        </table>


        <p>
        <a href="registered_Courses.php">
            See Registered Courses
        </a>
        </p>

    </section>

</main>    
<footer>
    <hr>
</footer>
</body>
</html>