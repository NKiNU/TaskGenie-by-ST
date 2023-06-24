<?php
include("db_connection.php");
session_start();

// Assign the user's ID to the session variable
$userid = $_SESSION['user_id'];

// Prepare and execute the SQL query to select the user data
$sql = "SELECT * FROM user WHERE userid = '$userid'";
$result = mysqli_query($conn, $sql);

if ($result) {
  $row = mysqli_fetch_assoc($result);
  $email = $row['email'];
  $username = $row['name'];
} else {
  // Handle query error
  die("Error retrieving user details: " . mysqli_error($conn));
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $newEmail = mysqli_real_escape_string($conn, $_POST['editemail']);
  $newUsername = mysqli_real_escape_string($conn, $_POST['editusername']);

  // Update the user's email and username in the database
  $updateQuery = "UPDATE user SET email = '$newEmail', name = '$newUsername' WHERE userid ='$userid'";
  $updateResult = mysqli_query($conn, $updateQuery);

  if ($updateResult) {
    // Update successful
    $_SESSION['user_email'] = $newEmail;
    $_SESSION['user_username'] = $newUsername;
    header("Location: profile.php");
    exit();
  } else {
    // Handle update error
    die("Error updating user profile: " . mysqli_error($conn));
  }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
  <link rel="stylesheet" href="style.css" />
  <title>Edit Profile</title>

  <!-- Web Icon-->
  <link rel="icon" type="image/png" href="images/webLogo.png">
</head>
<body>
  <div class="container">
    <h1>Edit Profile</h1>
    <form action="editProfile.php" method="post">
      <div class="form-group">
        <label for="editemail">Email:</label>
        <input type="email" class="form-control" id="editemail" name="editemail" value="<?php echo $email; ?>" placeholder="Enter email" required>
      </div>
      <div class="form-group">
        <label for="editusername">Username:</label>
        <input type="text" class="form-control" id="editusername" name="editusername" value="<?php echo $username; ?>" placeholder="Enter username" required>
      </div>
      <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
  </div>

  
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
