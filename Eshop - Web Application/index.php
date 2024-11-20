<?php
    include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up to E-Shop</title>
    <link rel="icon" href="resources/logo.svg"/>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head> 

<body class="d-flex flex-column min-vh-100 main_body">
    <div class="container-fluid flex-grow-1 d-flex justify-content-center">
        <div class="row align-content-center">

        <!-- Header - START -->
         <div class="col-12">
            <div class="row">
                <div class="col-12 logo"></div>
                <div class="col-12">
                    <p class="text-center title01">Hello, Welcome to eShop!</p>
                </div>
            </div>
         </div>
        <!-- Header - END -->

        <!-- Content - START -->
         <div class="col-12 p-2">
            <div class="row">
                <div class="col-6 d-none d-lg-block background"></div>

                <!-- SignUpBox - START -->
                 <div class="col-12 col-lg-6 d-none" id="signUpBox">
                    <div class="row">
                        <div class="col-12">
                            <p class="title02">Create New Account</p>
                        </div>

                        <!-- AlertBox - START -->
                        <div class="col-10 d-none" id="msgDiv1">
                            <div class="alert alert-danger" style="height: 5px; font-size: 13px; display: flex; align-items: center;" role="alert" id="msg1"></div>
                        </div>
                        <!-- AlertBox - END -->

                        <div class="col-5 me-1">
                            <label for="fname" class="mb-0 form-label label01">First Name: </label>
                            <input type="text" id="fname" class="form-control" placeholder="Ex: John">
                        </div>
                        <div class="col-5 me-1">
                            <label for="lname" class="mb-0 form-label label01">Last Name: </label>
                            <input type="text" id="lname" class="form-control" placeholder="Ex: Doe">
                        </div>
                        <div class="col-10 me-1">
                            <label for="email" class="mb-0 mt-2 form-label label01">Email Address: </label>
                            <input type="email" id="email" class="form-control" placeholder="Ex: johndoe@gmail.com">
                        </div>
                        <div class="col-10 me-1">
                            <label for="pw" class="mb-0 mt-2 form-label label01">Password: </label>
                            <input type="password" id="pw" class="form-control">
                        </div>
                        <div class="col-5 me-1">
                            <label for="mobile" class="mb-0 mt-2 form-label label01">Mobile Number: </label>
                            <input type="text" id="mobile" class="form-control" placeholder="Ex: 071*******">
                        </div>
                        <div class="col-5 me-1">
                            <label for="gender" class="mb-0 mt-2 form-label label01">Gender: </label>
                            <select class="form-select" id="gender">
                                <option value="0">Select Your Gender</option>
                                <?php
                                    $resultSet = Database::search("SELECT * FROM `gender`;");
                                    $rowCount = $resultSet->num_rows;

                                    for ($i = 0; $i<$rowCount; $i++) {
                                        $resultData = $resultSet->fetch_assoc();
                                        ?>
                                            <option value="<?php echo($resultData["gender_id"]);?>">
                                                <?php echo($resultData["gender_name"]);?>
                                            </option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>

                        <!-- SignUpBoxButtons - START -->
                        <div class="col-10 col-lg-5 d-grid mt-3">
                            <button class="btn btn-primary rounded-5" onclick="signUp();">Sign Up</button>
                        </div>
                        <div class="col-10 col-lg-5 d-grid mt-3">
                            <button class="btn btn-dark rounded-5" onclick="changeView();">Already Have an Account? Sign In</button>
                        </div>
                        <!-- SignUpBoxButtons - END -->

                    </div>
                 </div>
                <!-- SignUpBox - END -->

                <!-- SignInBox - START -->
                 <div class="col-12 col-lg-6 " id="signInBox">
                    <div class="row g-2">
                        <div class="col-12">
                            <p class="title02">Sign In to Account</p>
                        </div>

                        <!-- AlertBox - START -->
                        <div class="col-10 d-none" id="msgDiv2">
                            <div class="alert alert-danger" style="height: 5px; font-size: 13px; display: flex; align-items: center;" role="alert" id="msg2"></div>
                        </div>
                        <!-- AlertBox - END -->
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
                        <div class="col-10">
                            <label for="email2"  class="form-label label01">Email Address: </label>
                            <input value="<?php echo($email)?>" type="email" id="email2" class="form-control">
                        </div>
                        <div class="col-10">
                            <label for="pw2"  class="form-label label01">Password: </label>
                            <input value="<?php echo($password)?>" type="password" id="pw2" class="form-control">
                        </div>
                        
                        <div class="col-5 mt-3 mb-2">
                            <div class="form-check">
                                <input type="checkbox" id="remember" class="form-check-input">
                                <label class="form-check-label fw-bold">Remember Me</label>
                            </div>
                        </div>

                        <div class="col-5 text-end mt-3 mb-2">
                            <a href="#" class="link-primary fw-bold" onclick="forgotPassword();">Forgot Password?</a>
                        </div>

                        <!-- SignInBoxButtons - START -->
                        <div class="col-10 col-lg-5 d-grid">
                            <button class="btn btn-primary rounded-5" onclick="signIn();">Sign In</button>
                        </div>
                        <div class="col-10 col-lg-5 d-grid">
                            <button class="btn btn-danger rounded-5" onclick="changeView();">New to eShop? Sign Up</button>
                        </div>
                        <div class="col-10 d-grid mt-3">
                            <button class="btn btn-success rounded-5">Go To eShop Admins</button>
                        </div>
                        <!-- SignInBoxButtons - END -->

                    </div>
                 </div>
                <!-- SignInBox - END -->

            </div>
         </div>
        <!-- Content - END -->

        <!-- Modal - START -->
        <div class="modal" tabindex="-1" id="fpModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Forgot Password?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12 col-lg-6">
                                <label>New Password: </label>
                                <div class="input-group mb-3">
                                    <input type="password" id="np1" class="form-control">
                                    <button class="btn btn-primary" type="button" id="npb1" onclick="showPassword01();"><i class="bi bi-eye-fill" id="show1"></i></button>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label>Re-type Password: </label>
                                <div class="input-group mb-3">
                                    <input type="password" id="np2" class="form-control">
                                    <button class="btn btn-primary" type="button" id="npb2" onclick="showPassword02();"><i class="bi bi-eye-fill" id="show2"></i></button>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label mb-0">Verification Code</label>
                                <input type="text" id="vc" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset Password</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal - END -->

        <!-- Footer - START -->
         <div class="mt-auto text-center py-3">
            <p class="text-center">&copy; 2024 eShop.lk | All Rights Reserved</p>
            <p class="text-center fw-bold">Designed by 2024 Rhino Batch</p>
         </div>
        <!-- Footer - END -->

        </div>
    </div>

    <script src="js/bootstrap.js"></script>
    <script src="js/script.js"></script>

</body>

</html>