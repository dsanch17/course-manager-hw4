<?php
/**
 * ITIS 3105 Midterm
 * Dallas Sanchez
 */

require_once('database.php');


// Get all registered courses
$queryRegCourses = 'SELECT * FROM reg_courses ORDER BY regID';
$statement1 = $db->prepare($queryRegCourses);
$statement1->execute();
$registrationRows = $statement1->fetchAll();
$statement1->closeCursor();

function getCourseInfoFromID($db, $crs_ID)
{
    // This function calls the DB based on the course_id and returns the information for that course
    $queryCourseStatement = 'SELECT * FROM courses WHERE crs_ID = :crs_ID';
    $queryCoursePreperation = $db->prepare($queryCourseStatement);
    $queryCoursePreperation->bindValue(':crs_ID', $crs_ID);
    $queryCoursePreperation->execute();
    $thisCourse = $queryCoursePreperation->fetch();
    $queryCoursePreperation->closeCursor();

    return $thisCourse;
}


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
            <th>Code</th>
            <th>Title</th>
            <th>Credits</th>
            <th>Description</th>
            <th></th>
        </tr>

        <?php foreach ($registrationRows as $thisRegRow) : ?>
            <?php $course = getCourseInfoFromID($db, $thisRegRow['crs_ID']); ?>
            <tr>
                <td><?php echo $course['crs_code']; ?></td>
                <td><?php echo $course['crs_title']; ?></td>
                <td><?php echo $course['crs_credits']; ?></td>
                <td><?php echo $course['crs_description']; ?></td>

                <td>
                    <form method="post" action="dropCourse.php">
                        <input type="hidden" name="crs_ID" value="<?php echo $course['crs_ID']; ?>">

                        <button type="submit" value="drop" name="drop">Drop</button>
                    </form>
                </td>


            </tr>
        <?php endforeach; ?>
    </table> <br>

    <p>
        <a href="index.php">
            Back to Registration
        </a>
    </p>


</main>
<footer>
    <hr>
</footer>
</body>
</html>

