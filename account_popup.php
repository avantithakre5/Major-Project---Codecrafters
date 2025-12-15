<?php
session_start();
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
if (!$user) {
  header('Location: login.php');
  exit();
}
// DB connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "codecrafters";
$con = mysqli_connect($servername, $username, $password, $dbname);
if (!$con) die("Connection failed: " . mysqli_connect_error());
// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $new_name = mysqli_real_escape_string($con, $_POST['name']);
  $new_password = mysqli_real_escape_string($con, $_POST['password']);
  $skills = mysqli_real_escape_string($con, $_POST['skills']);
  $interests = mysqli_real_escape_string($con, $_POST['interests']);
  $email = mysqli_real_escape_string($con, $user['email']);
  // Update register table
  if ($new_name) {
    mysqli_query($con, "UPDATE register SET name='$new_name' WHERE email='$email'");
    $_SESSION['user']['name'] = $new_name;
  }
  if ($new_password) {
    mysqli_query($con, "UPDATE register SET password='$new_password' WHERE email='$email'");
  }
  // Insert/update personal_details table
  $exists = mysqli_query($con, "SELECT * FROM personal_details WHERE email='$email'");
  if (mysqli_num_rows($exists) > 0) {
    mysqli_query($con, "UPDATE personal_details SET skills='$skills', interests='$interests' WHERE email='$email'");
  } else {
    mysqli_query($con, "INSERT INTO personal_details (email, skills, interests) VALUES ('$email', '$skills', '$interests')");
  }
  $success = true;
}
// Fetch personal details
$details = ['skills'=>'', 'interests'=>''];
$res = mysqli_query($con, "SELECT * FROM personal_details WHERE email='" . mysqli_real_escape_string($con, $user['email']) . "'");
if ($row = mysqli_fetch_assoc($res)) $details = $row;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Account</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
  <style>
    body { background: rgba(8,7,16,0.85); color: #fff; font-family: 'Inter', sans-serif; }
    .popup-container {
      position: fixed; top:0; left:0; width:100vw; height:100vh; display:flex; align-items:center; justify-content:center; z-index:9999;
      background: rgba(8,7,16,0.45); backdrop-filter: blur(8px);
    }
    .popup-box {
      background: rgba(44,46,68,0.98); border-radius:18px; box-shadow:0 0 40px rgba(8,7,16,0.3); padding:40px 32px; min-width:320px; max-width:90vw; color:#fff; text-align:center; position:relative;
    }
    .popup-box h3 { color: #23a2f6; margin-bottom: 24px; }
    .form-label { color: #ffc107; font-weight: 600; }
    .form-control { background: rgba(255,255,255,0.07); color: #fff; border-radius:8px; border:none; margin-bottom:16px; }
    .btn-primary { background: linear-gradient(to right, #1845ad, #23a2f6, #ff512f, #f09819); border:none; font-weight:600; }
    .close-btn { position:absolute; top:12px; right:18px; background:none; border:none; color:#fff; font-size:1.5rem; cursor:pointer; }
    .success-msg { color: #23a2f6; font-weight:600; margin-bottom:12px; }
  </style>
</head>
<body>
  <div class="popup-container" id="accountPopup">
    <div class="popup-box">
      <button class="close-btn" onclick="window.close()">&times;</button>
      <h3>My Account</h3>
      <?php if (!empty($success)): ?><div class="success-msg">Updated successfully!</div><?php endif; ?>
      <form method="POST">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" >
        <label class="form-label">New Password</label>
        <input type="password" name="password" class="form-control" placeholder="Enter new password" />
        <label class="form-label">Skills</label>
        <input type="text" name="skills" class="form-control" value="<?php echo htmlspecialchars($details['skills']); ?>" >
        <label class="form-label">Interests</label>
        <input type="text" name="interests" class="form-control" value="<?php echo htmlspecialchars($details['interests']); ?>" >
        <button type="submit" class="btn btn-primary w-100 mt-3">Update</button>
      </form>
    </div>
  </div>
</body>
</html>
