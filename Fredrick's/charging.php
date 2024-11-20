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
                    <h2 style="font-size: 14px;">Charging</h2>
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
                        <img src="img/chargimg.jpg">
                        <h1>Charging Options</h1>
                        <p style="font-size: 13px; color: rgb(154, 152, 152);">You can choose any charging option from above options according to your preference.</p>
                    </center>
                    <div class="tiles">
                        <article class="tile">
                            <div class="tile-header">
                                <i class="ph-lightning-light"></i>
                                <h3>
                                    <span>Slow Charging</span>
                                    <span></span>
                                    
                                </h3>
                            </div>
                            <a href="slowcharging.php">
                                <span style="font-size: 10px;">Go to service</span>
                                <span class="icon-button">
                                    <i class="fa-solid fa-bolt"></i>
                                </span>
                            </a>
                        </article>
                        <article class="tile">
                            <div class="tile-header">
                                <i class="ph-fire-simple-light"></i>
                                <h3>
                                    <span>Fast Charging</span>
                                    <span></span>
                                </h3>
                            </div>
                            <a href="fastcharging.php">
                                <span style="font-size: 10px;">Go to service</span>
                                <span class="icon-button">
                                    <i class="fa-solid fa-bolt"></i>
                                </span>
                            </a>
                        </article>
                       
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