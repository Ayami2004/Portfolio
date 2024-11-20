<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="icon" href="img/favicon.png">
    <link rel="stylesheet" text = "text/css" href="style.css">

    <link rel="stylesheet" text="text/css" href="modal.css">

    <title>Fredricks Sign Up</title>
</head>
<body>
    <div class="container">

        <div class="content">
            <h1>User Details</h1>
            <p>We need your information to create a new account for you and this information must be true and accurate</p>
            <div style="margin-top: 10px;" class="email-log-in">
                <input style="border-radius: 5px;" type="text" id="fname" placeholder="">
                <label for="fname">Enter Your First Name</label>
            </div>
            <div style="margin-top: 10px;" class="email-log-in">
                <input style="border-radius: 5px;" type="text" id="lname" placeholder="">
                <label for="lname">Enter Your Last Name</label>
            </div><br/><br>
            <p>Provide a complaint number that is currently in use</p>
            <div style="margin-top: 10px;" class="email-log-in">
                <input style="border-radius: 5px;" type="text" id="mobile" placeholder="">
                <label for="mobile">Mobile Number</label>
            </div>
            <div style="margin-top: 20px; " class="action-buttons">
                <button onclick="signUp();" style=" cursor: pointer; border: none; padding: 18px; background-color:  #09f386;; font-weight: bold; font-size:17px; color:white;" class="primary-button">continue</button>
            </div>
            <br/>
            <p>I certify that all the information provided by you is true</p>
          
           
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

