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
<body style="overflow-y: hidden;" >
    <div  style="width: 85%;"class="app">
        <header style="margin-top: -30px;" class="app-header">
            <div class="app-header-logo">

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


    


            <div class="app-body-sidebar">
                <section style="margin-top: 50px;" class="payment-section">
                        <div style="background-color: rgb(46, 47, 47);padding-left: 20px; padding-top: 1px; padding-bottom: 5px; border-radius: 10px;">
                            <h2 style="font-size: 20px;">Charging Session - Summary</h2>
                        <div class="payment-section-header">
                            <p style="font-size: 12px; margin-top: -10px;">Check if the given details are accurate</p>
                            <div>
                            </div>
                        </div>
                        </div>
                        <?php
                            session_start();
                            require("connection.php");
                            $user_id = $_SESSION["u"]["id"];
                            $session_id = $_SESSION["charging_session_id"];
                            $session_search_q = "SELECT * FROM `charging_sessions` WHERE `id` = '".$session_id."'";
                            $resultSet = $connection->query($session_search_q);
                            $resultData = $resultSet->fetch_assoc();
                            $charger_id = $resultData["charger_id"];

        
                        ?>
                       <div class="chargingdetails">
                        <h3>User : <span><?php echo($_SESSION["u"]["first_name"]. " " . $_SESSION["u"]["last_name"]);?></span></h3>
                        <h3>Vehicle No : <span><?php echo($_SESSION["charging_session_vehicleno"]);?></span></h3>
                        <?php 
                            $search_charger_type_q = "SELECT * FROM `chargers` WHERE `id` = '".$charger_id."'";
                            $chargerResultSet = $connection->query($search_charger_type_q);
                            $chargerResultData = $chargerResultSet->fetch_assoc();
                            $chargerType = $chargerResultData["charger_type"];

                            $search_cost_q = "SELECT `rate_per_unit` FROM `charger_type` WHERE `type` = '".$chargerType."'";
                            $costResultSet = $connection->query($search_cost_q);
                            $costResultData = $costResultSet->fetch_assoc();
                        ?>
                        <h3>Charger Type : <span><?php echo($chargerType);?></span></h3>
                        <h3>Charger No : <span>Charger 0<?php echo($resultData["charger_id"]);?></span></h3>
                        <h3>Units Consumed : <span><?php echo($resultData["units_consumed"]);?></span></h3>
                        <h3>Cost Per Unit : <span><?php echo($costResultData["rate_per_unit"]);?></span></h3>
                        <h3>Total Amount : <span><?php echo($_SESSION["charging_cost"]);?></span></h3>

                       </div>
                        <a><button style="margin-left: 10px;"class="vehiclebtn">Back</button></a>
                        <button style="margin-left: 20px;background-color: rgb(37, 241, 153);color: black;border:none;" class="vehiclebtn" onclick="paymentGateway();">Pay Now</button>







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
            <a href="#" >
                <i style="font-size: 45px; margin-top: -20px;" class="fa-solid fa-circle-plus"></i>

              
            </a>
        </li>
        <li >
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
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="https://kit.fontawesome.com/59d0659d08.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>

</body>
</html>