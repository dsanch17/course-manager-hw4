<?php
/**
 * Created by PhpStorm.
 * User: Dallas
 * Date: 11/5/16
 * Time: 1:38 AM
 */
session_start(); //*V>< DONT FORGET SESSION START ><V*

require_once('database.php');

$error = false;

//TODO: need to check for pre-existing session/cookie value

//check if the post array had a username value sent to it
if (isset( $_POST["username"]) ) {
    if (isset( $_POST["password"]) ) {
        $user = searchDBForUsername($db, $_POST["username"]);
        if ($user != null) {
            if ($user["password"] == $_POST["password"]) {

                if ($_POST["rememberBox"] == true) {
                    //TODO: set a cookie instead of a session
                }

                $_SESSION["role"] = $user["role"];
                $_SESSION["name"] = $user["firstName"];
                if ($user["role"] == "student") {
                    $_SESSION["deptID"] = $user["deptID"];
                }

                redirectUserToHome($user);
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

function redirectUserToHome($u) {
    if ($u["role"] == "manager") {
        header("Location: ./manager_home.php"); //manager redirect
        die();
    } else {
        header("Location: ./student_home.php"); //student redirect
        die();
    }

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
        <br>

        <input type="checkbox" name="rememberBox"><label>Remember me</label>

    </form>


</main>
<footer>
    <hr>
</footer>
</body>
</html>
