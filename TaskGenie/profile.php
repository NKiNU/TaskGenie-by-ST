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
  <title>Profile</title>

  <!-- Web Icon-->
  <link rel="icon" type="image/png" href="images/webLogo.png">
</head>
<body>
  <?php 
  include_once("db_connection.php");
  session_start();
  
  // Check if user is logged in
  if (!isset($_SESSION['user_email']) || !isset($_SESSION['user_username'])) {
    header("Location: login.php");
    exit;
  }
  
  // Retrieve user details from the database
  $userEmail = $_SESSION['user_email'];
  $userUsername = $_SESSION['user_username'];
 // After successful login or registration
  // $_SESSION['user_id'] = $userID; // Assign the user's ID to the session variable

// Retrieve the user ID from the session
// $userID = $_SESSION['user_id'];
  
  // Query the database to get user details
  $query = "SELECT * FROM user WHERE email = '".$_SESSION['user_email']."' AND name = '$userUsername'";
  $result = mysqli_query($conn, $query);
  
  // Check if the query was successful
  if ($result) {
    $user = mysqli_fetch_assoc($result);
  } else {
    // Handle error case
    echo "Error: " . mysqli_error($conn);
  }
  
  // Close the database connection
 
  ?>

  <div class="main-container d-flex">
    <!-- START OF SIDEBAR-->
    <div class="sidebar" id="side_nav">
      <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
        <h1 class="fs-4"><span class="bg-white text-dark rounded shadow px-2 me-2">TaskGenie</span></h1>
      </div>

      <ul class="list-unstyled px-2">
        <li class=""><a href="dashboard.php" class="text-decoration-none px-3 py-2 d-block" style="margin: 1em;"><i class="fal fa-home"></i> Dashboard</a></li>
        <li class=""><a href="task.php" class="text-decoration-none px-3 py-2 d-block" style="margin: 1em;"><i class="fal fa-list"></i> Tasks</a></li>
      </ul>
      <hr class="h-color mx-2">
      <ul class="list-unstyled px-2 mx-auto">
        <li class="active"><a href="profile.php" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-user"></i> User Profile</a></li>
      </ul>
    </div>
    <!-- END OF SIDEBAR-->

    <div class="content d-flex flex-column" id="backgroundxc">
      <nav class="navbar navbar-expand-md">
        <div class="d-flex justify-content-between d-md-none d-block">
          <button class="btn px-1 py-0 open-btn me-2"><i class="fal fa-bars"></i></button>
          <a class="navbar-brand fs-4"><span class="bg-dark rounded px-2 py-0 text-white">TaskGenie</span></a>
        </div>
        <h1 class="mx-auto">Profile</h1>
      </nav>

      <div class="container mx-auto flex-fill">

        <div class="text-center my-4">
          <div class="rounded-circle overflow-hidden mx-auto" style="width: 150px; height: 150px;">
            <img id="profile-pic" src="images/default_pfp.avif" alt="Profile Picture" class="w-100 h-100 object-fit-cover" style="object-fit: cover;">
          </div>
        </div>

        <div class="text-center" style="margin-top: 10px;">
          <div id="user-info">
            <div class="form-group">
              <label for="email">Email:</label>
              <p id=""><?php echo $_SESSION['user_email']?></p>
            </div>
            <div class="form-group">
              <label for="username">Username:</label>
              <p id=""><?php echo $_SESSION['user_username'] ?></p>
            </div>
            <a href="editProfile.php" class="btn btn-primary mr-2">Edit Profile</a>
            <a href="profileDeleteAcc.php" type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal">Delete Account</a>
            <a href="profileLogOut.php"  class="btn btn-danger"> Sign Out </a>
            
          </div>
        </div>

        <div class="modal fade" id="confirmPasswordModal" tabindex="-1" role="dialog" aria-labelledby="confirmPasswordModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="confirmPasswordModalLabel">Confirm Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="current-password">Please enter your current password to confirm:</label>
                  <input type="password" class="form-control" id="current-password">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="confirmPassword()">Confirm</button>
              </div>
            </div>
          </div>
        </div>

        <div id="edit-form" style="display: none;">
          <form action="processUpdate.php" method="post">
            <div class="mt-3">
              <label for="pic-upload" class="btn btn-primary">Upload Picture</label>
              <input id="pic-upload" type="file" accept="image/*" style="display: none;">
            </div>
            <div class="form-group">
              <label for="edit-username">Username:</label>
              <input type="text" class="form-control" id="edit-username" placeholder="Enter username">
            </div>
            <div class="form-group">
              <label for="edit-email">Email:</label>
              <input type="email" class="form-control" id="edit-email" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="edit-password">Password:</label>
              <input type="password" class="form-control" id="edit-password" placeholder="Enter password">
            </div>
            <div class="form-group">
              <label for="edit-confirm-password">Confirm Password:</label>
              <input type="password" class="form-control" id="edit-confirm-password" placeholder="Confirm password">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <button type="button" class="btn btn-secondary" onclick="cancelEdit()">Cancel</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Account Deletion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete your account? This action cannot be undone.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" onclick="deleteAccount()">Delete Account</button>
      </div>
    </div>
  </div>
</div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.4/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  <!-- <script src="script.js"></script> -->
 <script>
  function deleteAccount() {
    window.location.href = "deleteUser.php";
  }
</script>

</body>
</html>
