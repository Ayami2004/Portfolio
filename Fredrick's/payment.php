<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="homestyle.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-sOMEiP8o2o9I9M0B4B4z1fN4A5yJcXrgkP7zeaX0Pd9GAVK77hfrtZACwYk3M3a06g6lJ9CwDz5UxOHQR0gbcw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://kit.fontawesome.com/59d0659d08.js" crossorigin="anonymous"></script>
</head>

<body>
    <div style="width: 85%;" class="app">
        <header style="margin-top: -30px;" class="app-header">
            <div class="app-header-logo">
                <div class="logo">
                    <span class="logo-icon">
                    </span>

                </div>
            </div>
            <div class="app-header-navigation">
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
            </div>
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
            <div class="app-body-main-content">
                <section class="service-section">
                    <h2 style="font-size: 14px;">Payment</h2>
                    <div class="service-section-header">
                        <div class="search-field">
                            <i class="ph-magnifying-glass"></i>
                            <input type="text" placeholder="Account number">
                        </div>
                        <div class="dropdown-field">
                            <select>
                                <option>Home</option>
                                <option>Work</option>
                            </select>
                            <i class="ph-caret-down"></i>
                        </div>
                        <button class="flat-button">
                            Search
                        </button>
                    </div>
                    <div class="mobile-only">
                        <button class="flat-button">
                            Toggle search
                        </button>
                    </div>
                    <center>
                        
                        <div class="pa">
                            <img style="margin-top: -40px;" src="./img/payimg.png" alt="" width="300px" height="200px">
                            <?php
                        session_start();
                            require("connection.php");
                            $user_id = $_SESSION["u"]["id"];
                            $search_multiple_vehicle_users_q = "SELECT `id`, `vehicle_no` FROM `vehicles` WHERE `user_id` = '".$user_id."';";
                            $resultSet = $connection->query($search_multiple_vehicle_users_q);
                            $vehicleCount = $resultSet->num_rows;
                            if ($vehicleCount > 1) {
                                ?>
                                <h1 style="margin-top: -20px; font-size: 28px;" >Select the Charged Vehicle</h1>
                                <select id="vehicleNo" style="width: 200px; height: 30px;">
                                <?php
                                while ($vehicleData = $resultSet->fetch_assoc()) { 
                                    ?> 
                                    <option value="<?php echo ($vehicleData['id']); ?>"><?php echo ($vehicleData['vehicle_no']); ?></option>
                                    <?php
                                }
                                ?>
                                </select><br/><br/><br>
                                <?php
                            } else if ($vehicleCount == 1) {
                                $_SESSION["charging_session_id"] = $session_id;
                                $oneVehicleId = $vehicleData["id"];
                                $_SESSION["charging_session_vehicleno"] = $oneVehicleId;
                            } else if ($vehicleCount == 0) {
                                $_SESSION["charging_session_vehicleno"] = "N/A";
            
                            }
                            
                        ?>
                            <h1 style="margin-top: -20px; font-size: 28px;" >Enter Charging Units</h1>
                             <p style="margin-top: -20px;font-size: 14px;color: rgb(83, 83, 83);" class="p_pay">enter your consumed charghing units in below and get ready for payment</p>
                                  <input id="chargingUnits" style="width: 60%;height: 70px;border-radius: 50px;background-color: rgb(26, 26, 26);border: 1px solid rgb(77, 77, 77);font-size: 35px;color: white;text-align: center;" type="number" placeholder="00"  class="units" />
                                  
                                 
                         
                             </div>
                          </br>
                        </br>

                        
                            <button style="width: 50%; padding: 10px;border-radius: 15px; font-size: 15px; color: rgb(0, 0, 0); background-color:#45ffbc;cursor: pointer;" onclick="proceedToPayment();">Proceeed To Payment</button> </div>
                    

                     </div>
                    </center>
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
                <i style="font-size: 17px;color: rgb(29, 246, 174);" class="fa-regular fa-credit-card"></i>

            </a>
        </li>
        <li>
            <a href="profile.php">
                <i style="font-size: 17px;" class="fa-solid fa-user"></i>

            </a>
        </li>

    </ul>

    <script src="script.js"></script>
</body>

</html>