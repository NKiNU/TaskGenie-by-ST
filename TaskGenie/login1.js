document.addEventListener('DOMContentLoaded', function() {

  function isValidEmail(email) {
    // Basic email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  var forgotPasswordLink = document.getElementById('forgotPasswordLink');
  var myModal = new bootstrap.Modal(document.getElementById('forgotPasswordModal'));

  forgotPasswordLink.addEventListener('click', function() {
    myModal.show();
  });

  // Login form validation
  const loginSubmitButton = document.getElementById('loginSubmitButton');

  loginSubmitButton.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent form submission

    const loginEmail = document.getElementById('loginEmail');
    const loginPassword = document.getElementById('loginPassword');

    // Check if email is valid
    if (!isValidEmail(loginEmail.value)) {
      alert('Please enter a valid email address.');
      return;
    }

    if(loginPassword.value===''){//or wrong password to be put soon
      alert('Incorrect Password.');
      return;
    }

    // Submit the form if all fields are valid
    //alert('Form submitted successfully!');
    window.location.href = "processLogin.php";

  });


  document.getElementById("loginSubmitButton").addEventListener("click", function() {
    var emailInput = document.getElementById("loginEmail");
    var passwordInput = document.getElementById("loginPassword");
  

    // Check if email and password fields are not empty
    if (emailInput.value.trim() === "" || passwordInput.value.trim() === "") {
        alert("Email and password are required. Please enter valid values.");
        return;
    }

    // Submit the form if all validations pass
    document.getElementById("loginForm").submit();
});


// Register form validation
const registerSubmitButton = document.getElementById('registerSubmitButton');
const registerForm = document.getElementById('registerForm');
const termsCheckbox = document.getElementById('registerCheckbox');

function updateRegisterButtonStatus() {
  const isFormValid = registerForm.checkValidity() && termsCheckbox.checked;
  registerSubmitButton.disabled = !isFormValid;
}

registerForm.addEventListener('input', updateRegisterButtonStatus);
termsCheckbox.addEventListener('change', updateRegisterButtonStatus);

// Call the function initially to disable the register button
updateRegisterButtonStatus();

registerSubmitButton.addEventListener('click', function(event) {
  event.preventDefault(); // Prevent form submission

  const registerEmail = document.getElementById('email');
  const registerPassword = document.getElementById('password');
  const registerConfirmPassword = document.getElementById('confirmPassword');

  // Check if email is valid
  if (!isValidEmail(registerEmail.value)) {
    alert('Please enter a valid email address.');
    return;
  }

  // Check if password and confirm password fields match
  if (registerPassword.value !== registerConfirmPassword.value) {
    alert('Passwords do not match.');
    return;
  }

  if (!termsCheckbox.checked) {
    alert('Please agree to the terms and conditions.');
    return;
  }

  // Submit the form if all fields are valid
  //alert('Form submitted successfully!');
  window.location.href = 'processRegister.php';
});


    document.getElementById("registerSubmitButton").addEventListener("click", function() {
        var emailInput = document.getElementById("email");
        var passwordInput = document.getElementById("password");
        var confirmPasswordInput = document.getElementById("confirmPassword");

        // Check if email and password fields are not empty
        if (emailInput.value.trim() === "" || passwordInput.value.trim() === "") {
            alert("Email and password are required. Please enter valid values.");
            return;
        }

        // Check if password and confirm password fields match
        if (passwordInput.value !== confirmPasswordInput.value) {
            alert("Password and confirm password fields do not match. Please enter the same password in both fields.");
            return;
        }

        // Submit the form if all validations pass
        document.getElementById("registerForm").submit();
    });

});
