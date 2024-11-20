<?php
session_start();
include("connection.php");

if (isset($_SESSION["u"])) {
    $userEmail = $_SESSION["u"]["email"];
    $pageNo;
    $userResultSet = Database::search("SELECT * FROM `user` WHERE `email` = '" . $userEmail . "'");
    $userData = $userResultSet->fetch_assoc();

    $imgResultSet = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $userEmail . "'");
    $imgCount = $imgResultSet->num_rows;

?>
    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>My Products | eShop</title>

        <link rel="stylesheet" href="css/bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="css/style.css" />

        <link rel="icon" href="resources/logo.svg" />

    </head>

    <body style="background-color: #E9EBEE;">

        <div class="container-fluid">
            <div class="row">

                <!-- header -->
                <div class="col-12 bg-primary">
                    <div class="mt-2"></div>
                    <div class="row">

                        <div class="col-12 col-lg-4">
                            <div class="row">

                                <?php
                                if ($imgCount > 0) {
                                    $imgData = $imgResultSet->fetch_assoc();
                                ?>
                                    <div class="col-12 col-lg-4 mt-1 mb-1 text-center">
                                        <img src="<?php echo ($imgData["img_path"]); ?>" width="90px" height="90px" class="rounded-circle" />

                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="col-12 col-lg-4 mt-1 mb-1 text-center">
                                        <img src="resources/new_user.svg" width="90px" height="90px" class="rounded-circle" />

                                    </div>
                                <?php
                                }
                                ?>

                                <div class="col-12 col-lg-8">
                                    <div class="row text-center text-lg-start">
                                        <div class="col-12 mt-0 mt-lg-4">
                                            <span class="text-white fw-bold"><?php echo ($userData["fname"] . " " . $userData["lname"]); ?></span>
                                        </div>
                                        <div class="col-12">
                                            <span class="text-black-50 fw-bold"><?php echo ($userEmail); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-8">
                            <div class="row">
                                <div class="col-12 col-lg-10 mt-2 my-lg-4">
                                    <h1 class="offset-4 offset-lg-2 text-white fw-bold">My Products</h1>
                                </div>
                                <div class="col-12 col-lg-2 mx-2 mb-2 my-lg-4 mx-lg-0 d-grid">
                                    <a href="addProduct.php"><button class="btn btn-warning fw-bold">Add Product</button></a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="mt-2"></div>
                </div>
                <!-- header -->

                <!-- body -->
                <div class="col-12">
                    <div class="row">
                        <!-- filter -->
                        <div class="col-11 col-lg-2 mx-3 my-3 rounded">
                            <div class="row">
                                <div class="col-12 mt-3 fs-5">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-3">Sort Products</label>
                                        </div>
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-10">
                                                    <input type="text" placeholder="Search..." class="form-control" id="s" />
                                                </div>
                                                <div class="col-1 p-1">
                                                    <label class="form-label"><i class="bi bi-search fs-5"></i></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-bold">Active Time</label>
                                        </div>
                                        <div class="col-12">
                                            <hr style="width: 80%;" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r1" id="n">
                                                <label class="form-check-label" for="n">
                                                    Newest to oldest
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r1" id="o">
                                                <label class="form-check-label" for="o">
                                                    Oldest to newest
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By quantity</label>
                                        </div>
                                        <div class="col-12">
                                            <hr style="width: 80%;" />
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r2" id="h">
                                                <label class="form-check-label" for="h">
                                                    High to low
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r2" id="l">
                                                <label class="form-check-label" for="l">
                                                    Low to high
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By condition</label>
                                        </div>
                                        <div class="col-12">
                                            <hr style="width: 80%;" />
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r3" id="b">
                                                <label class="form-check-label" for="b">
                                                    Brandnew
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r3" id="u">
                                                <label class="form-check-label" for="u">
                                                    Used
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 text-center mt-3 mb-3">
                                            <div class="row g-2">
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-success fw-bold" onclick="sort01(0);">Sort</button>
                                                </div>
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-primary fw-bold" onclick="clearSort();">Clear</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- filter -->

                        <!-- product -->
                        <div class="col-12 col-lg-9 mt-3 mb-3 bg-white">
                            <div class="row" id="sort">

                                <!-- AlertBox - START -->
                                <center>
                                    <div class="col-8 mt-3 d-none" id="msgDiv">
                                        <div class="alert alert-success" style="height: 5px; font-size: 13px; display: flex; align-items: center;" role="alert" id="msg"></div>
                                    </div>
                                </center>
                                <!-- AlertBox - END -->

                                <div class="offset-1 col-10 text-center">
                                    <div class="row justify-content-center">

                                        <?php
                                        if (isset($_GET["page"])) {
                                            $pageNo = $_GET["page"];
                                        } else {
                                            $pageNo = 1;
                                        }

                                        $productResultSet = Database::search("SELECT * FROM `product` WHERE `user_email` = '" . $userEmail . "'");

                                        $productCount = $productResultSet->num_rows;

                                        $productsPerPage = 4;

                                        $pagesReq = ceil($productCount / $productsPerPage);

                                        $productsToSkip = ($pageNo - 1) * $productsPerPage;

                                        $productDisplay = Database::search("SELECT * FROM `product` WHERE `user_email` = '" . $userEmail . "' LIMIT $productsPerPage OFFSET $productsToSkip");

                                        $selectedProductCount = $productDisplay->num_rows;

                                        if ($selectedProductCount > 0) {
                                            for ($i = 0; $i < $selectedProductCount; $i++) {
                                                $selectedProductData = $productDisplay->fetch_assoc();
                                        ?>
                                                <!-- card -->
                                                <div class="card mb-3 mt-3 ms-1 me-1 col-10 col-lg-5">
                                                    <div class="row">
                                                        <?php
                                                        $productImg = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $selectedProductData["id"] . "'");
                                                        $productImgCount = $productImg->num_rows;
                                                        if ($productImgCount == 0) {
                                                        ?>
                                                            <div class="col-md-4 mt-4">
                                                                <img src="resources/addproductimg.svg" class="img-fluid rounded-start" />
                                                            </div>
                                                        <?php
                                                        } else {
                                                            $productImgData = $productImg->fetch_assoc();

                                                        ?>
                                                            <div class="col-md-4 mt-4">
                                                                <img src="<?php echo ($productImgData["img_path"]); ?>" class="img-fluid rounded-start" />
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>

                                                        <div class="col-md-8">
                                                            <div class="card-body">
                                                                <h5 class="card-title fw-bold"><?php echo ($selectedProductData["title"]); ?></h5>
                                                                <span class="card-text fw-bold text-primary">Rs. <?php echo ($selectedProductData["price"]); ?>
                                                                    .00</span><br />
                                                                <span class="card-text fw-bold text-success"><?php echo ($selectedProductData["qty"]); ?> Items left</span>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox" role="switch" id="toggle<?php echo ($selectedProductData["id"]); ?>" onchange="changeProductStatus(<?php echo ($selectedProductData['id']); ?>)" <?php
                                                                                                                                                                                                                                                                        if ($selectedProductData["status_status_id"] == 1) {
                                                                                                                                                                                                                                                                        ?> checked <?php
                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                    ?> />
                                                                    <label class="form-check-label fw-bold text-info" for="toggle<?php echo ($selectedProductData["id"]); ?>">
                                                                        <?php
                                                                        if ($selectedProductData["status_status_id"] == 1) {
                                                                        ?>
                                                                            Deactivate Product
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            Activate Product
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </label>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="row g-1">
                                                                            <div class="col-12 d-grid">
                                                                                <a href="updateProduct.php?id=<?php echo ($selectedProductData["id"]); ?>"><button class="btn btn-success fw-bold">Update</button></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- card -->
                                        <?php
                                            }
                                        } else {
                                            echo ("You have no products to display");
                                        }
                                        ?>

                                    </div>
                                </div>

                                <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination pagination-lg justify-content-center">
                                            <li class="page-item">
                                                <a class="page-link" href="
                                                    <?php
                                                    if ($pageNo <= 1) {
                                                        echo ("#");
                                                    } else {
                                                        echo "?page=" . ($pageNo - 1);
                                                    }
                                                    ?>
                                                " aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <?php
                                            for ($z = 1; $z <= $pagesReq; $z++) {
                                                if ($pageNo == $z) {
                                            ?>
                                                    <li class="page-item active">
                                                        <a class="page-link" href="<?php echo "?page=".($z);?>"><?php echo($z);?></a>
                                                    </li>
                                                <?php
                                                } else {
                                                ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="<?php echo "?page=".($z);?>"><?php echo($z);?></a>
                                                    </li>
                                            <?php

                                                }
                                            }
                                            ?>

                                            <li class="page-item">
                                                <a class="page-link" href="
                                                <?php
                                                if ($pageNo >= $pagesReq) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageNo + 1);
                                                }
                                                ?>
                                                " aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>

                            </div>
                        </div>
                        <!-- product -->

                    </div>
                </div>
                <!-- body -->

            </div>
        </div>

        <script src="js/script.js"></script>
    </body>

    </html>

<?php
} else {
    header("Location:home.php");
}


?>