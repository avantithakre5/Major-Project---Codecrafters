<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "codecrafters";

$con = mysqli_connect($servername, $username, $password, $dbname);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $con->prepare("SELECT * FROM register WHERE email=? AND password=?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $_SESSION['user'] = ['name' => $row['name'], 'email' => $row['email']];
    header("Location: dash.php");
    exit();
} else {
    header("Location: login.php?error=1");
    exit();
}

$stmt->close();
$con->close();
?>