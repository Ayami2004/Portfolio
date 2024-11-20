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
    <div  style="width: 85%;" class="app">
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
                    <br/>
                    <h2 style="font-size: 25px; text-align: left;">Welcome to Fredrick's</h2>
                    <p>Charge ahead with ease and sustainability. Manage your EV charging sessions effortlessly.</p>
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
                    <div class="tiles">
                        <article class="tile">
                            <div class="tile-header">
                                <i class="ph-lightning-light"></i>
                                <h3>
                                    <span>Charge Vehicle</span>
                                    <span style="font-size: 13px;">Start charging now and drive green.</span>
                                    
                                </h3>
                            </div>
                            <a href="charging.php">
                                <!-- <span style="font-size: 10px;">Go to service</span> -->
                                <span class="icon-button">
                                    <i class="fa-solid fa-bolt"></i>
                                </span>
                            </a>
                        </article>
                        <article class="tile">
                            <div class="tile-header">
                                <i class="ph-fire-simple-light"></i>
                                <h3>
                                    <span>Pay Now</span>
                                    <span style="font-size: 13px;">Manage payments for your charging sessions</span>
                                </h3>
                            </div>
                            <a href="payment.php">
                                <!-- <span style="font-size: 10px;">Go to service</span> -->
                                <span class="icon-button">
                                    <i class="fa-solid fa-bolt"></i>
                                </span>
                            </a>
                        </article>
                        <article class="tile">
                            <div class="tile-header">
                                <i class="ph-file-light"></i>
                                <h3>
                                    <span>View Profile</span>
                                    <span style="font-size: 13px;">Manage your personal info and vehicle details</span>
                                </h3>
                            </div>
                            <a href="profile.php">
                                <!-- <span style="font-size: 10px;">Go Your Profile</span> -->
                                <span class="icon-button">
                                    <i class="fa-solid fa-bolt"></i>
                                </span>
                            </a>
                        </article>
                    </div>
                    <div class="service-section-footer">
                        <p>Services are paid according to the current state of the currency and tariff.</p>
                    </div>
                </section>
                
            </div>
            <div style="margin-top: -80px;" class="app-body-sidebar">
                <!-- <section class="payment-section">
                    <h2>Your payments</h2>
                    <div class="payment-section-header">
                        <p>Your payments and payables</p>
                        <div>
                            <button class="card-button mastercard">
                                <svg width="2001" height="1237" viewBox="0 0 2001 1237" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="a624784f2834e21c94a1c0c9a58bbbaa">
                                        <path id="7869b07bea546aa59a5ee138adbcfd5a" d="M1270.57 1104.15H729.71V132.15H1270.58L1270.57 1104.15Z" fill="currentColor"></path>
                                        <path id="b54e3ab4d7044a9f288082bc6b864ae6" d="M764 618.17C764 421 856.32 245.36 1000.08 132.17C891.261 46.3647 756.669 -0.204758 618.09 9.6031e-07C276.72 9.6031e-07 0 276.76 0 618.17C0 959.58 276.72 1236.34 618.09 1236.34C756.672 1236.55 891.268 1189.98 1000.09 1104.17C856.34 991 764 815.35 764 618.17Z" fill="currentColor"></path>
                                        <path id="67f94b4d1b83252a6619ed6e0cc0a3a1" d="M2000.25 618.17C2000.25 959.58 1723.53 1236.34 1382.16 1236.34C1243.56 1236.54 1108.95 1189.97 1000.11 1104.17C1143.91 990.98 1236.23 815.35 1236.23 618.17C1236.23 420.99 1143.91 245.36 1000.11 132.17C1108.95 46.3673 1243.56 -0.201169 1382.15 -2.24915e-05C1723.52 -2.24915e-05 2000.24 276.76 2000.24 618.17" fill="currentColor"></path>
                                    </g>
                                </svg>
                            </button>
                            <button class="card-button visa active">
                                <svg xmlns="http://www.w3.org/2000/svg" width="2500" height="2500" viewBox="0 0 141.732 141.732">
                                    <g fill="currentColor">
                                        <path d="M62.935 89.571h-9.733l6.083-37.384h9.734zM45.014 52.187L35.735 77.9l-1.098-5.537.001.002-3.275-16.812s-.396-3.366-4.617-3.366h-15.34l-.18.633s4.691.976 10.181 4.273l8.456 32.479h10.141l15.485-37.385H45.014zM121.569 89.571h8.937l-7.792-37.385h-7.824c-3.613 0-4.493 2.786-4.493 2.786L95.881 89.571h10.146l2.029-5.553h12.373l1.14 5.553zm-10.71-13.224l5.114-13.99 2.877 13.99h-7.991zM96.642 61.177l1.389-8.028s-4.286-1.63-8.754-1.63c-4.83 0-16.3 2.111-16.3 12.376 0 9.658 13.462 9.778 13.462 14.851s-12.075 4.164-16.06.965l-1.447 8.394s4.346 2.111 10.986 2.111c6.642 0 16.662-3.439 16.662-12.799 0-9.72-13.583-10.625-13.583-14.851.001-4.227 9.48-3.684 13.645-1.389z" />
                                    </g>
                                    <path d="M34.638 72.364l-3.275-16.812s-.396-3.366-4.617-3.366h-15.34l-.18.633s7.373 1.528 14.445 7.253c6.762 5.472 8.967 12.292 8.967 12.292z" fill="currentColor" />
                                    <path fill="none" d="M0 0h141.732v141.732H0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="payments">
                        <div class="payment">
                            <div class="card green">
                                <span>01/22</span>
                                <span>
                                    •••• 4012
                                </span>
                            </div>
                            <div class="payment-details">
                                <h3 style="font-size: 11px;">Enough to pay</h3>
                                <div>
                                    <span style="font-size: 13px;">Rs.100.00</span>
                                    <button class="icon-button">
                                        <i class="ph-caret-right-bold"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="payment">
                            <div class="card olive">
                                <span>12/23</span>
                                <span>
                                    •••• 2228
                                </span>
                            </div>
                            <div class="payment-details">
                                <h3 style="font-size: 11px;">Remaining amount</h3>
                                <div>
                                    <span style="font-size: 13px;">Rs.100.00</span>
                                    <button class="icon-button">
                                        <i class="ph-caret-right-bold"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </section> -->
            </div>
        </div>
    </div>
    <br/><br/><br/>
    <ul class="bottom-nav">
        
        <li>
            <a href="home.php">
                <i style="color: rgb(29, 246, 174);font-size: 17px;" class="fas fa-home"></i> 
                
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
                <i style="font-size: 17px;" class="fa-regular fa-credit-card"></i>
                
            </a>
        </li>
        <li>
            <a href="profile.php">
                <i style="font-size: 17px;" class="fa-solid fa-user"></i>
                
            </a>
        </li>
       
    </ul>
    
    
</body>
</html>