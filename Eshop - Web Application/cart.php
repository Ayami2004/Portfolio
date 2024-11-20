<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cart | eShop</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css" />

    <link rel="icon" href="resources/logo.svg" />

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php
            include "header.php";
            include("connection.php");

            if (!isset($_SESSION["u"])) {
                echo ("Please Log In to View your Cart");
            }

            ?>

            <div class="col-12 pt-2" style="background-color: #E3E5E4;">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
                    </ol>
                </nav>
            </div>

            <div class="col-12 border border-1 border-primary rounded mb-3">
                <div class="row">

                    <div class="col-12">
                        <label class="form-label fs-1 fw-bold">Cart <i class="bi bi-cart4 fs-1 text-success"></i></label>
                    </div>

                    <div class="col-12 col-lg-6">
                        <hr />
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="offset-lg-2 col-12 col-lg-6 mb-3">
                                <input type="text" class="form-control" placeholder="Search in Cart..." />
                            </div>
                            <div class="col-12 col-lg-2 mb-3 d-grid">
                                <button class="btn btn-outline-primary">Search</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr />
                    </div>

                    <?php
                    $userEmail = $_SESSION["u"]["email"];
                    $cartRS = Database::search("SELECT * FROM `cart` INNER JOIN `product` ON `product`.`id` = `cart`.`cart_product_id` INNER JOIN `color` ON `color`.`id` = `product`.`color_id` INNER JOIN `condition` ON `condition`.`id` = `product`.`condition_id` INNER JOIN `user` ON `product`.`user_email` = `user`.`email` WHERE `cart_user_email` = '" . $userEmail . "'");
                    $cartCount = $cartRS->num_rows;

                    if ($cartCount == 0) {
                    ?>

                        <!-- Empty View -->
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 emptyCart"></div>
                                <div class="col-12 text-center mb-2">
                                    <label class="form-label fs-1 fw-bold">
                                        You have no items in your Cart yet.
                                    </label>
                                </div>
                                <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                                    <a href="home.php" class="btn btn-outline-info fs-3 fw-bold">
                                        Start Shopping
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Empty View -->
                    <?php
                    } else if ($cartCount > 0) {
                        $total = 0;
                        $subtotal = 0;
                        $shipping = 0;

                    ?>
                        <div class="col-12 col-lg-9">
                            <div class="row">
                                <?php

                                for ($i = 0; $i < $cartCount; $i++) {
                                    $cartData = $cartRS->fetch_assoc();
                                    $total = $total + ($cartData["price"] * $cartData["cart_qty"]);

                                    $addressRS = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON `user_has_address`.`city_id`= `city`.`id` INNER JOIN `district` ON `district`.`id` = `city`.`district_id` WHERE `user_email` = '" . $userEmail . "'");
                                    $addressData = $addressRS->fetch_assoc();

                                    $ship = 0;
                                    if ($addressData["district_id"] == 1) {
                                        $ship = $cartData["delivery_fee_colombo"];
                                        $shipping = $shipping + $ship;
                                    } else {
                                        $ship = $cartData["delivery_fee_other"];
                                        $shipping = $shipping + $ship;
                                    }

                                    $subtotal = $total + $shipping;

                                ?>


                                    <div class="card mb-3 mx-0 col-12">
                                        <div class="row g-0">
                                            <div class="col-md-12 mt-3 mb-3">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5"><?php echo ($cartData["fname"] . " " . $cartData["lname"]); ?></span>&nbsp;
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>

                                            <?php 
                                                $productImgRS = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '".$cartData["cart_product_id"]."'");
                                                $productImg = $productImgRS->fetch_assoc();
                                            ?>

                                            <div class="col-md-4">

                                                <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                                                    data-bs-content="<?php echo ($cartData["description"]); ?>" title="Product Description">
                                                    <img src="<?php echo($productImg["img_path"]);?>" class="img-fluid rounded-start" style="max-width: 200px;">
                                                </span>

                                            </div>
                                            <div class="col-md-5">
                                                <div class="card-body">

                                                    <h3 class="card-title"><?php echo ($cartData["title"]); ?></h3>

                                                    <span class="fw-bold text-black-50">Colour : <?php echo ($cartData["color"]); ?></span> &nbsp; |

                                                    &nbsp; <span class="fw-bold text-black-50">Condition : <?php echo ($cartData["condition"]); ?></span>
                                                    <br>
                                                    <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                                    <span class="fw-bold text-black fs-5">Rs. <?php echo ($cartData["price"]); ?> .00</span>
                                                    <br>
                                                    <span class="fw-bold text-black-50 fs-5">Quantity :</span>&nbsp;
                                                    <input type="number" class="mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cardqtytext" value="<?php echo ($cartData["cart_qty"]); ?>">
                                                    <br><br>

                                                    <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;
                                                    <span class="fw-bold text-black fs-5">Rs. <?php echo ($ship); ?> .00</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card-body d-grid">
                                                    <a class="btn btn-outline-success mb-2">Buy Now</a>
                                                    <a onclick="removeFromCart(<?php echo ($cartData['cart_id']); ?>);" class="btn btn-outline-danger mb-2">Remove</a>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="col-md-12 mt-3 mb-3">
                                                <div class="row">
                                                    <div class="col-6 col-md-6">
                                                        <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                    </div>
                                                    <div class="col-6 col-md-6 text-end">
                                                        <span class="fw-bold fs-5 text-black-50">Rs. <?php echo (($cartData["price"] * $cartData["cart_qty"]) + $ship); ?> .00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            

                        <!-- products -->
                <?php
                                }

                                ?>
                                </div>
                                </div>
                                <?php
                            }
                ?>

                <!-- summary -->
                <div class="col-12 col-lg-3">
                    <div class="row">

                        <div class="col-12">
                            <label class="form-label fs-3 fw-bold">Summary</label>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <div class="col-6 mb-3">
                            <span class="fs-6 fw-bold">items (<?php echo ($cartCount); ?>)</span>
                        </div>

                        <div class="col-6 text-end mb-3">
                            <span class="fs-6 fw-bold">Rs. <?php echo ($total); ?> .00</span>
                        </div>

                        <div class="col-6">
                            <span class="fs-6 fw-bold">Shipping</span>
                        </div>

                        <div class="col-6 text-end">
                            <span class="fs-6 fw-bold">Rs. <?php echo ($shipping); ?> .00</span>
                        </div>

                        <div class="col-12 mt-3">
                            <hr />
                        </div>

                        <div class="col-6 mt-2">
                            <span class="fs-4 fw-bold">Total</span>
                        </div>

                        <div class="col-6 mt-2 text-end">
                            <span class="fs-4 fw-bold">Rs. <?php echo ($subtotal); ?> .00</span>
                        </div>

                        <div class="col-12 mt-3 mb-3 d-grid">
                            <button class="btn btn-primary fs-5 fw-bold">CHECKOUT</button>
                        </div>

                    </div>
                </div>
                <!-- summary -->

                </div>
            </div>

            <?php include "footer.php"; ?>

        </div>
    </div>


    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/script.js"></script>

    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
</body>

</html>