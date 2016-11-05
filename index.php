<?php
/**
 * Created by PhpStorm.
 * User: Dallas
 * Date: 11/5/16
 * Time: 1:38 AM
 */

require_once('database.php');

$error = false;

if (isset( $_POST["username"]) ) {
    if (isset( $_POST["password"]) ) {
        $user = searchDBForUsername($db, $_POST["username"]);
        if ($user != null) {
            if ($user["password"] == $_POST["password"]) {

                //need to check for if it's a student or a manager for redirect

                //need to set session/cookie value before redirecting
                header("Location: ./registered_Courses.php");
                die();
            }
        }

        $error = true;
    }
}

// Get all registered courses
$queryRegCourses = 'SELECT * FROM reg_courses ORDER BY regID';
$statement1 = $db->prepare($queryRegCourses);
$statement1->execute();
$registrationRows = $statement1->fetchAll();
$statement1->closeCursor();

function searchDBForUsername($db, $username)
{
    // This function calls the DB based on the username and returns the information for that user
    $queryUserStatement = 'SELECT * FROM users WHERE userName = :userName';
    $queryUserPreperation = $db->prepare($queryUserStatement);
    $queryUserPreperation->bindValue(':userName', $username);
    $queryUserPreperation->execute();
    $thisUser = $queryUserPreperation->fetch();
    $queryUserPreperation->closeCursor();

    return $thisUser;
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

    <?php if ($error) echo "<p class='errorMessage'>Username and Password are not found</p>"; ?>

    <p class="center"><img src="unccLogo.png" width="365" height="157"/></p>

    <br>

    <form method="post" action="index.php">
        <b>Username</b> <br>
        <input type="text" name="username" class="loginTextbox" required> <br>
        <b>Password</b> <br>
        <input type="password" name="password" class="loginTextbox" required> <br>
        <br>
        <input type="submit" value="Login" class="loginButton">


    </form>


</main>
<footer>
    <hr>
</footer>
</body>
</html>
