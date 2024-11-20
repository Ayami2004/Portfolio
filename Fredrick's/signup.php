<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="img/favicon.png">
    <link rel="stylesheet" text="text/css" href="style.css">

    <link rel="stylesheet" text="text/css" href="modal.css">
    <title>Fredricks Sign Up</title>
</head>

<body>
    <div class="container" style="overflow: hidden;">

        <div class="content">
            <h1>Register</h1>
            <p style="margin-top: -20px;">Create your account to start charging smarter.</p>
            <div style="margin-top: 10px;" class="email-log-in">
                <input type="text" id="email" placeholder="" onblur="checkEmail();">
                <label for="email">Enter Your Email Address</label>
            </div>
            <div style="margin-top: 10px;" class="email-log-in">
                <input type="password" id="pw" placeholder="">
                <label for="pw">New Password</label>
            </div>
            <div class="divider">
                <p>or</p>
            </div>
            <div class="action-buttons">
                <button style="cursor: pointer;" class="primary-button sign-in-button">
                    <object data="img/google.svg"></object>
                    <span>Sign Up with Google</span>
                </button>
                <button style=" cursor: pointer ;margin-top: -10px;" class="primary-button sign-in-button">
                    <object data="img/facebook.svg"></object>
                    <span>Sign Up with Facebook</span>
                </button>
            </div>

            <div style="margin-top: 20px;" class="action-buttons sign-up">
                <button onclick="saveAndSignUp();" style="cursor: pointer; border: none; padding: 18px; background-color:  #09f386;; font-weight: bold; font-size:17px; color:white;" class="primary-button">Next</button>
                <p>Already have an account? <a href="signin.php">Sign in</a></p>
            
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