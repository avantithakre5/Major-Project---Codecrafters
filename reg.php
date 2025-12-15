<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "codecrafters"; // Use your database name

$con = mysqli_connect($servername, $username, $password, $dbname);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Insert data into the database
$sql = "INSERT INTO `register`(`name`, `email`, `password`) 
        VALUES ('$name','$email','$password')";

$result = mysqli_query($con, $sql);
if ($result) {
    // Redirect to login.php on success
    header("Location: login.php?reg=success");
    exit();
} else {
    // Redirect to login.php with an error status
    header("Location: login.php?status=error");
    exit();
}

mysqli_close($con);
?>