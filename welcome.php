<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.html");
    exit();
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f7f7f7;
        }
        .dashboard-container {
            display: flex;
            height: 100vh;
        }
        .sidebar {
            width: 260px;
            background: #1845ad;
            color: #fff;
            padding: 40px 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .sidebar h2 {
            margin-bottom: 30px;
            font-size: 24px;
            letter-spacing: 1px;
        }
        .user-details {
            margin-bottom: 40px;
        }
        .user-details p {
            margin: 10px 0;
            font-size: 16px;
        }
        .main-content {
            flex: 1;
            padding: 60px;
            text-align: left;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background: #ff512f;
            color: #fff;
            border: none;
            border-radius: 6px;
            margin-top: 30px;
        }
        button:hover {
            background: #f09819;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <h2>User Details</h2>
            <div class="user-details">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            </div>
            <button onclick="window.location.href='index.html'">Logout</button>
        </div>
        <div class="main-content">
            <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
            <p>This is your dashboard. You can add more dashboard features here.</p>
        </div>
    </div>
</body>
</html>