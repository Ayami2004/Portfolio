<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" text="text/css" href="modal.css">

    <link rel="stylesheet" text="text/css" href="style.css">
    <link rel="icon" href="img/favicon.png">
    <title>Fredricks Sign in</title>
</head>

<body>
    <div class="container">

        <div class="content">
            <h1>Login</h1>
            <p style="margin-top: -10px;">Charge Up and Go Green! Sign in to continue to your account.</p>

            <div class="action-buttons">
                <button style="cursor: pointer;" class="primary-button sign-in-button">
                    <object data="img/google.svg"></object>
                    <span>Sign in with Google</span>
                </button>
                <button style=" cursor: pointer ;margin-top: -10px;" class="primary-button sign-in-button">
                    <object data="img/facebook.svg"></object>
                    <span>Sign in with Facebook</span>
                </button>
            </div>
            <div class="divider">
                <p>or</p>
            </div>

            <?php
                $email ="";
                $password = "";
                
                if(isset($_COOKIE["email"])) {
                    $email = $_COOKIE["email"];
                }

                if (isset($_COOKIE["password"])) {
                    $password = $_COOKIE["password"];
                }
            ?>

            <div class="email-log-in">
                <input value = "<?php echo($email);?>" type="email" id="email" placeholder="">
                <label for="email">Enter Your Email</label>
            </div>
            <div style="margin-top: 10px;" class="email-log-in">
                <input value = "<?php echo($password);?>" type="password" id="pw" placeholder="">
                <label for="pw">Enter Your Password</label>
            </div>

            <div class="row">
                <div class="remember-me">
                    <label for="rememberMe">Remember Me</label> &nbsp;
                    <input type="checkbox" id="rememberMe">
                </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="forgot-password">
                    <a href="forgot_password.php">Forgot Password?</a>
                </div>
            </div>

            <div style="margin-top: 2px; " class="action-buttons sign-up">
                <button onclick="checkAndSignIn();" style=" cursor: pointer; border: none; padding: 15px; background-color:  #09f386;; font-weight: bold; font-size:17px; color:white;" class="primary-button">Sign in</button>
                <p>Don't have an account? <a href="signup.php">Sign up</a></p>
            </div>
        </div>
        <!-- The Modal -->
        <div id="errorModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal();">&times;</span>
                <p class="error-message" id="errorMessage"></p>
            </div>
        </div>
    </div>
    <script src="script.js"></script>

</body>

</html>