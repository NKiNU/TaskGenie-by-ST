<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="login.css">

    <!-- Web Icon-->
    <link rel="icon" type="image/png" href="images/webLogo.png">

    <!-- Web Title-->
    <title>TaskGenie</title>

</head>

<body class="d-flex align-items-center justify-content-center vh-100">
<?php
// Start the session
session_start();

// Check if the login message is set in the session
if (isset($_SESSION['login_message'])) {
    $login_message = $_SESSION['login_message'];

    // Clear the login message from the session
    unset($_SESSION['login_message']);

    // Generate JavaScript code to display the alert
    echo "<script>alert('$login_message');</script>";
}

?>

    <!-- START OF MAIN-->
    <main>
        <?php
        if (isset($_SESSION['user_id'])) {
    // Session is active, continue with your code
} else {
    // Session is not active, display alert message
    echo  '     <div class="alert alert-primary" role="alert">
                You Not Login Yet ! 
                </div>';

}
    ?>

        <section class="Form my-4 mx-auto">
            <div class="container">
                <div class="row g-0">
                    <div class="col-lg-5 d-flex">
                        <img src="images/loginnn.png" class="float-start img-fluid" style="max-width: 110%;">
                    </div>
                    <div class="col-lg-7 px-5 pt-5">
                        <h1>TaskGenie</h1>
                        <h4>Sign in to your account</h4>
                        <div id="errorDiv">
                            <?php
                            if (isset($_GET['error']) && $_GET['error'] == 1) {
                                echo "Invalid email or password";
                            }
                            ?>
                        </div>
                        <form id="loginForm" method="post" action="processLogin.php" class="login-form" style="align-content-center">
                            <div class="form-row">
                                <div class="col-lg-7">
                                    <input type="email" id="loginEmail" name="loginEmail" placeholder="Enter your email" class="form-control my-3 p-4" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-7">
                                    <input type="password" id="loginPassword" name="loginPassword" placeholder="Enter your password" class="form-control my-3 p-4" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-7">
                                    <button type="submit" id="loginSubmitButton" class="button1 btn-outline-success me-2m-auto"> Login </button>
                                </div>
                            </div>
                        </form>

                        <!-- Button Trigger Modal-->
                        <a id="forgotPasswordLink" class="btn btn-link d-flex">Forgot password?</a>

                        <!-- Forgot Password-->
                        <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="mb-3">
                                                <label for="forgotPasswordEmail" class="form-label">Email address</label>
                                                <input type="email" class="form-control" id="forgotPasswordEmail" required>
                                            </div>
                                            <button type="submit" class="btn btn-outline-success me-2m-auto">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Register Button Trigger Modal -->
                        <p>Don't have an account?
                            <button type="button" class="btn btn-outline-success me-2m-auto" data-bs-toggle="modal" data-bs-target="#registerModal">
                                Register here
                            </button>
                        </p>

                        <!-- Register Modal -->
                        <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="registerModalLabel">New User Registration</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="registerForm" method="POST" action="processRegister.php">
                                         <div class="mb-3">
                                                <label for="registrationName" class="form-label">Username</label>
                                                <input type="text" class="form-control" name="name" id="name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="registrationEmail" class="form-label">Email address</label>
                                                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="registrationPassword" class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password" id="password" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="registrationConfirmPassword" class="form-label">Confirm password</label>
                                                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" required>
                                                <div class="invalid-feedback" id="passwordError"></div>
                                            </div>
                                            <div class="check-terms">
                                                <input type="checkbox" id="registerCheckbox" class="checkbox" required>
                                                <span class="check-label">I agree to the terms and conditions.</span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="registerSubmitButton" class="btn btn-outline-success me-2m-auto">Register</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- END OF MAIN -->
    



    <!-- Include Bootstrap JavaScript plugin -->
    <script src="login1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    

</body>
</html>
