<?php
    $dsn = 'mysql:host=localhost;dbname=university_schema';
    $username = 'root';
    $password = 'password1';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>