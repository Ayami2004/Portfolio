<?php
require("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="homestyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-sOMEiP8o2o9I9M0B4B4z1fN4A5yJcXrgkP7zeaX0Pd9GAVK77hfrtZACwYk3M3a06g6lJ9CwDz5UxOHQR0gbcw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/59d0659d08.js" crossorigin="anonymous"></script>
</head>

<body>
    <div style="width: 85%;" class="app">
        <header style="margin-top: -30px;" class="app-header">
            <div class="app-header-logo">

            </div>
            <!-- <div class="app-header-navigation">
                <div class="tabs">
                    <a href="#">
                        Overview
                    </a>
                    <a href="#" class="active">
                        Payments
                    </a>
                    <a href="#">
                        Cards
                    </a>
                    <a href="#">
                        Account
                    </a>
                    <a href="#">
                        System
                    </a>
                    <a href="#">
                        Business
                    </a>
                </div>
            </div> -->
            <div class="app-header-actions">
                <button class="user-profile">
                    <span>Matheo Peterson</span>
                    <span>
                        <img src="https://assets.codepen.io/285131/almeria-avatar.jpeg" />
                    </span>
                </button>
                <div class="app-header-actions-buttons">
                    <button class="icon-button large">
                        <i class="ph-magnifying-glass"></i>
                    </button>
                    <button class="icon-button large">
                        <i class="ph-bell"></i>
                    </button>
                </div>
            </div>
            <div class="app-header-mobile">

            </div>

        </header>
        <div class="app-body">
            <div class="app-body-navigation">

            </div>
            <?php
                    session_start();

                    // Mobile
                    $user_id = $_SESSION["u"]["id"];
                    $mobile_q = "SELECT `contact`.`mobile` FROM `contact` WHERE `user_id`='" . $user_id . "';";
                    $resultSet = $connection->query($mobile_q);
                    $mobileData = $resultSet->fetch_assoc();

                    //Vehicle Infomation
                    $vehicle_q = "SELECT * FROM `vehicles` WHERE `user_id` = '" . $user_id . "';";
                    $resultSet2 = $connection->query($vehicle_q);
                    $vehicleCount = $resultSet2->num_rows;

                    ?>
            <div class="app-body-sidebar">
                <section class="payment-section">
                    <h2 style="font-size: 20px;margin-top: -10px;">Edit Your Details</h2>
                    <div class="payment-section-header">
                        <p style="font-size: 12px;margin-top: -10px;">Edit your personal information here</p>
                        <div>

                        </div>
                    </div>
                    <span style="margin-top: -15px; font-size: 10px; color: rgb(71, 71, 71);">First Name</span><br />
                    <input class="profileinput" id="fname" type="text" value="<?php echo ($_SESSION["u"]["first_name"]); ?>" /><br />
                    <span style="margin-top: -15px; font-size: 10px; color: rgb(71, 71, 71);">Last Name</span><br />
                    <input class="profileinput" id="lname" type="text" value="<?php echo ($_SESSION["u"]["last_name"]); ?>" /><br />
                    <span style="margin-top: -15px; font-size: 10px; color: rgb(71, 71, 71);">NIC</span><br />
                    <input class="profileinput" id="nic" type="text" value="<?php echo ($_SESSION["u"]["nic"]); ?>" />
                    <span style="margin-top: -15px; font-size: 10px; color: rgb(71, 71, 71);">Mobile Number</span><br />
                    <input class="profileinput" id="mobile" type="number" value="<?php echo ($mobileData["mobile"]); ?>" />
                    
                    <button class="vehiclebtn" onclick = "editProfile();">Save Changes</button>
                    <a href="profile.php"><button class="vehiclebtn" style="background-color: rgb(43, 218, 142);border: 1px solid black; color: black;margin-left: 5px;">Cancel</button></a>
                    <section class="payment-section">
                        <h2 style="font-size: 20px;">Your Vehicle Details</h2>
                        <div class="payment-section-header">
                            <p style="font-size: 12px;margin-top: -10px;">Edit your Vehicle information</p>  
                        </div>
<div class="vehicle-section" id="vehicleSection">
                        <?php
                    if ($vehicleCount > 0) {
                        for ($i = 1; $i <= $vehicleCount; $i++) {
                            $vehicleInfo = $resultSet2->fetch_assoc();
                    ?>
                    <div class="vehicle-info">
                            <p>Vehicle 0<?php echo ($i); ?></p>
                            <span style="margin-top: -15px; font-size: 10px; color: rgb(71, 71, 71);">Vehicle No</span><br />
                            <input readonly class="profileinput" type="text" value="<?php echo ($vehicleInfo["vehicle_no"]); ?>" /><br />
                            <span style="margin-top: -15px; font-size: 10px; color: rgb(71, 71, 71);">Vehicle Model</span><br />
                            <input readonly class="profileinput" type="text" value="<?php echo ($vehicleInfo["vehicle_model"]); ?>" /><br />
                            <button class="delete-vehicle vehiclebtn" onclick="deleteVehicle(this)">Delete</button>
                            </div>
                        <?php

                        }
                    } else {
                        ?>
                        <p>No vehicles to Display. To add vehicles, please click on Edit Profile</p>
                    <?php
                    }
                    ?>
                    </div>
                        <button class="vehiclebtn" onclick="addVehicleHTML();">Add Vehicle</button>
                        <button class="vehiclebtn" onclick ="saveVehicle();">Save Changes</button>
                        <a href="profile.php"><button class="vehiclebtn" style="background-color: rgb(43, 218, 142);border: 1px solid black; color: black;margin-left: 5px;">Cancel</button></a>

                        <div class="payments">
                            <div class="payment">

                            </div>
                            <div class="payment">


                                <div class="payment-details">

                                </div>
                            </div>
                        </div>
                    </section>
            </div>
        </div>
        <div class="tiles">
        </div>
        <div class="service-section-footer">
            <p>Services are paid according to the current state of the currency and tariff.</p>
        </div>
        </section>

    </div>
    </section>
    </div>
    </div>
    </div>
    <ul class="bottom-nav">

        <li>
            <a href="home.php">
                <i style="font-size: 17px;" class="fas fa-home"></i>

            </a>
        </li>
        <li>
            <a href="charging.php">
                <i style="font-size: 17px;" class="fa-solid fa-bolt"></i>

            </a>
        </li>
        <li>
            <a href="#">
                <i style="font-size: 45px; margin-top: -20px;" class="fa-solid fa-circle-plus"></i>


            </a>
        </li>
        <li>
            <a href="payment.php">
                <i style="font-size: 17px;" class="fa-regular fa-credit-card"></i>

            </a>
        </li>
        <li>
            <a href="profile.php">
                <i style="font-size: 17px;color: rgb(29, 246, 174);" class="fa-solid fa-user"></i>

            </a>
        </li>

    </ul>

    <script src="https://kit.fontawesome.com/59d0659d08.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>