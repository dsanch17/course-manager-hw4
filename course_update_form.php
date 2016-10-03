<?php
/**
 * Created by PhpStorm.
 * User: Dallas
 * Date: 9/29/16
 * Time: 7:08 PM
 */

/**<select name="question2">
<option selected="selected">Romance/ Reality TV</option>
<option>Action/ Thriller /Crime</option>
<option>Drama/ Documentary/Natural Films</option>
<option>Comedy / Animation</option>
<option>Science Fiction/ Fantasy</option>

</select>*/
require_once('database.php');

$courseID = filter_input(INPUT_POST,'crs_ID');


// Get all departments
$queryAllDepartments = 'SELECT * FROM department ORDER BY departmentID';
$statement1 = $db->prepare($queryAllDepartments);
$statement1->execute();
$departments = $statement1->fetchAll();
$statement1->closeCursor();

// Get data for selected course
$queryCourse = 'SELECT * FROM courses WHERE crs_ID = :courseID';
$statement3 = $db->prepare($queryCourse);
$statement3->bindValue(':courseID', $courseID);
$statement3->execute();
$course = $statement3->fetch();
$statement3->closeCursor();


?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title>Update Course</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<main>
    <h1 style="color: black">University Courses Manager</h1>
    <hr>
    <h1>Update Course</h1>

    <form method="post" action="updateCourse.php">

        <label>Department:</label>
        <select name="departmentID">
            <?php foreach ($departments as $department) : ?>

            <option value="<?php echo $department['departmentID'];?>"
                <?php if ($department['departmentID'] == $course['dep_id']) {
                    echo ' selected = "selected"';
                }
                ?> > <?php echo $department['departmentName']; ?>
                <?php endforeach; ?>
        </select>
        <br>

        <label>Code: </label><input type="number" name="code" required value="<?php echo $course['crs_code']; ?>">
        <br>
        <label>Title: </label><input type="text" name="title" required value="<?php echo $course['crs_title']; ?>">
        <br>
        <label>Credits :</label><input type="number" name="credits" step="1" required value="<?php echo $course['crs_credits']; ?>">
        <br><br>
        <label>Description: </label><textarea name="description" rows="5" cols="40" required><?php echo $course['crs_description']; ?></textarea>
        <br>

        <input type="hidden" name="courseID" value="<?php echo $courseID;?>">

        <button type="submit" value="Update Course">Update Course</button>
    </form>

    <p>
        <a href="index.php">
            View Course List
        </a>
    </p>