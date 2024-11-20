<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charging</title>
    <link rel="stylesheet" href="homestyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-sOMEiP8o2o9I9M0B4B4z1fN4A5yJcXrgkP7zeaX0Pd9GAVK77hfrtZACwYk3M3a06g6lJ9CwDz5UxOHQR0gbcw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    
                    <h1 style="text-align: center; margin-top: -30px;">Select Your Fast Charger</h1><br />
                    <p style="text-align: center;font-size: 13px; margin-top: -20px; color: rgb(124, 123, 123);">Select your charging method as your preference button and then click on the start button</p>
                    <div class="appContainer" style="margin-top: 5px;">

                        <div class="tiles">
                            <?php
                            require("connection.php");
                            $charger_q = "SELECT * FROM `chargers` WHERE `charger_type` = 'fast' AND `status` = '1';";
                            $resultSet = $connection->query($charger_q);
                            $chargerCount = $resultSet->num_rows;
                            for ($i = 1; $i <= $chargerCount; $i++) {
                                $chargerResult = $resultSet->fetch_assoc();
                                $chargerId = $chargerResult["id"];

                            ?>
                                <button class="tile" id="<?php echo $chargerId; ?>" onclick="handleChargerClick('<?php echo $chargerId; ?>')">
                                    <div class="tile-header">
                                        <i class="ph-lightning-light"></i>
                                        <h3>
                                            <span>Fast Charger 0<?php echo($i);?></span>
                                            <span></span>

                                        </h3>
                                    </div>
                                    <a >
                                        <span style="font-size: 10px;">Click the service</span>
                                        <span class="icon-button">
                                            <i class="fa-solid fa-bolt"></i>
                                        </span>
                                    </a>
                            </button>
                            <?php
                            }
                            ?>

                        </div>


                    </div>

                    <center>
                        <a>
                            <button class="startstopbtn" id="startChargingButton">START</button>
                        </a>
                    </center>





            </div>
            <div class="service-section-footer">
                <p>Services are paid according to the current state of the currency and tariff.</p>
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
                <i style="font-size: 17px;color: rgb(29, 246, 174);" class="fa-solid fa-bolt"></i>

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
                <i style="font-size: 17px;" class="fa-solid fa-user"></i>

            </a>
        </li>

    </ul>

<script src="script.js"></script>
</body>

</html>