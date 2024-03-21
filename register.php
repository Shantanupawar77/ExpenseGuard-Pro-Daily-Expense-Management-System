<?php
require('config.php');
if (isset($_REQUEST['firstname'])) {
    $firstname = stripslashes($_REQUEST['firstname']);
    $firstname = mysqli_real_escape_string($con, $firstname);
    $lastname = stripslashes($_REQUEST['lastname']);
    $lastname = mysqli_real_escape_string($con, $lastname);
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    $trn_date = date("Y-m-d H:i:s");

    // Check if the user already exists
    $check_query = "SELECT * FROM `users` WHERE email='$email'";
    $check_result = mysqli_query($con, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        // User already exists, show error message
        echo "<script>alert('User already exists. Please try with another email.');</script>";
    } else {
        // User does not exist, proceed with registration
        $query = "INSERT INTO `users` (firstname, lastname, password, email, trn_date) VALUES ('$firstname','$lastname', '" . md5($password) . "', '$email', '$trn_date')";
        $result = mysqli_query($con, $query);
        if ($result) {
            header("Location: login.php");
            exit(); // It's a good practice to exit after redirection
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
} else {
    // echo "Form submission failed.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExpenseGuard Pro</title>
    <link rel="icon" href="favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">

    <style>
    @import url("https://fonts.googleapis.com/css?family=Muli&display=swap");
    @import url("https://fonts.googleapis.com/css?family=Open+Sans:400,500&display=swap");

    * {
        box-sizing: border-box;
    }

    body {
        background-color: #f0f0f0;
        font-family: "Open Sans", sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        margin: 0;
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
        height: 100vh;
    }

    .container {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 400px;
        max-width: 100%;
        margin: 20px;
    }

    .header {
        border-bottom: 1px solid #f0f0f0;
        background-color: #f7f7f7;
        padding: 20px 40px;
    }

    .header h2 {
        margin: 0;
        color: #333;
    }

    .form {
        padding: 30px 40px;
    }

    .form-control {
        margin-bottom: 20px;
        position: relative;
    }

    .form-control label {
        display: block;
        margin-bottom: 5px;
        color: #555;
    }

    .form-control input {
        border: 1px solid #ccc;
        border-radius: 4px;
        font-family: inherit;
        font-size: 14px;
        padding: 10px;
        width: 100%;
        transition: border-color 0.3s ease;
    }

    .form-control input:focus {
        outline: 0;
        border-color: #8e44ad;
    }

    .form-control.success input {
        border-color: #2ecc71;
    }

    .form-control.error input {
        border-color: #e74c3c;
    }

    .form-control i {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        color: #ccc;
    }

    .form-control.success i.fa-check-circle {
        color: #2ecc71;
    }

    .form-control.error i.fa-exclamation-circle {
        color: #e74c3c;
    }

    .form-control small {
        color: #e74c3c;
        position: absolute;
        bottom: 0;
        left: 0;
        display: none;
    }

    .form-control.error small {
        display: block;
    }

    button[type="submit"] {
        background-color: #0F1035;
        border: none;
        border-radius: 4px;
        color: #fff;
        font-family: inherit;
        font-size: 16px;
        padding: 12px;
        width: 100%;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #365486;
    }

    .text-center {
        text-align: center;
    }

    .text-center a {
        color: #0F1035;
        text-decoration: none;
    }

    .text-center a:hover {
        text-decoration: underline;
    }

    .container {
        text-align: center;
    }

    .header h2 {
        color: #8e44ad;
        margin-bottom: 5px;
    }

    .header h3 {
        margin: 0;
        color: #333;
    }

    button[type="submit"] {
        margin-top: 20px;
    }

    .header h2 {
        color: #0F1035;
        margin-bottom: 5px;
    }

    .header h3 {
        margin: 10px 0 0;
        color: #333;
    }

    button[type="submit"] {
        margin-top: 5px;
        margin-bottom: 3px;
    }

    .margin-less {
        margin-top: 0.2px;
        padding-top: 0px;
    }

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }
    </style>
    <script>
    const form = document.getElementById("form");
    const username = document.getElementById("username");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const password2 = document.getElementById("password2");

    form.addEventListener("submit", (e) => {
        e.preventDefault();

        checkInputs();
    });

    function checkInputs() {
        // trim to remove the whitespaces
        const usernameValue = username.value.trim();
        const emailValue = email.value.trim();
        const passwordValue = password.value.trim();
        const password2Value = password2.value.trim();

        if (usernameValue === "") {
            setErrorFor(username, "Username cannot be blank");
        } else {
            setSuccessFor(username);
        }

        if (emailValue === "") {
            setErrorFor(email, "Email cannot be blank");
        } else if (!isEmail(emailValue)) {
            setErrorFor(email, "Not a valid email");
        } else {
            setSuccessFor(email);
        }

        if (passwordValue === "") {
            setErrorFor(password, "Password cannot be blank");
        } else {
            setSuccessFor(password);
        }

        if (password2Value === "") {
            setErrorFor(password2, "Password2 cannot be blank");
        } else if (passwordValue !== password2Value) {
            setErrorFor(password2, "Passwords does not match");
        } else {
            setSuccessFor(password2);
        }
    }

    function setErrorFor(input, message) {
        const formControl = input.parentElement;
        const small = formControl.querySelector("small");
        formControl.className = "form-control error";
        small.innerText = message;
    }

    function setSuccessFor(input) {
        const formControl = input.parentElement;
        formControl.className = "form-control success";
    }

    function isEmail(email) {
        return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            .test(
                email
            );
    }
    </script>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>ExpenseGuard Pro</h2>
            <h3>Register</h3>
        </div>
        <form id=" form" class="form" action="" method="POST" autocomplete="off">
            <div class="form-control">
                <label for="firstname">First Name</label>
                <input type="text" placeholder="" id="firstname" name="firstname" required="required" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="lastname">Last Name</label>
                <input type="text" placeholder="" id="lastname" name="lastname" required="required" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="username">Email</label>
                <input type="email" placeholder="" id="email" name="email" required="required" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" placeholder="" id="password" name="password" required="required" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" placeholder="re-enter" id="confirm_password" name="confirm_password"
                    required="required" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <button type="submit" class="btn btn-danger btn-lg btn-block" style="border-radius:0%;">Register</button>
        </form>
        <div class="text-center margin-less">Already have an account? <a class="text-success" href="login.php">Login
                Here</a></div>
    </div>
</body>

</html>