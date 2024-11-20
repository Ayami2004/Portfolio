<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Watchlist | eShop</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css" />

    <link rel="icon" href="resources/logo.svg" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php"; ?>

            <div class="col-12">
                <div class="row">
                    <div class="col-12 border border-1 border-primary rounded mb-2">
                        <div class="row">

                            <div class="col-12">
                                <label class="form-label fs-1 fw-bolder">Watchlist &hearts;</label>
                            </div>

                            <div class="col-12 col-lg-6">
                                <hr />
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="offset-lg-2 col-12 col-lg-6 mb-3">
                                        <input type="text" class="form-control" placeholder="Search in Watchlist..." />
                                    </div>
                                    <div class="col-12 col-lg-2 mb-3 d-grid">
                                        <button class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr />
                            </div>

                            <div class="col-11 col-lg-2 border-0 border-end border-1 border-dark">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                    </ol>
                                </nav>
                                <nav class="nav nav-pills flex-column">
                                    <a class="nav-link active" aria-current="page" href="#">My Watchlist</a>
                                    <a class="nav-link" href="#">My Cart</a>
                                    <a class="nav-link" href="#">Recents</a>
                                </nav>
                            </div>

                            <div class="col-12 col-lg-9">
                                <div class="row">
                                    <?php
                                    include("connection.php");
                                    if (isset($_SESSION["u"])) {
                                        $userEmail = $_SESSION["u"]["email"];

                                        $watchListRS = Database::search("SELECT * FROM `watchlist` INNER JOIN `product` ON `watchlist`.`product_id` = `product`.`id` INNER JOIN `condition` ON `condition`.`id` = `product`.`condition_id` INNER JOIN `color` ON `color`.`id` = `product`.`color_id` INNER JOIN `user` on `user`.`email` = `product`.`user_email` WHERE `watchlist`.`user_email` = '" . $userEmail . "'");
                                        $watchListCount = $watchListRS->num_rows;

                                        if ($watchListCount == 0) {
                                    ?>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12 emptyView"></div>
                                                    <div class="col-12 text-center">
                                                        <label class="form-label fs-1 fw-bold">You have no items in your Watchlist
                                                            yet.</label>
                                                    </div>
                                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                                        <a href="home.php" class="btn btn-warning fs-3 fw-bold">Start Shopping</a>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        } else {
                                            for ($i = 0; $i < $watchListCount; $i++) {
                                                $watchListData = $watchListRS->fetch_assoc();

                                                $productImgRS = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '".$watchListData["product_id"]."'");
                                                $productImg = $productImgRS->fetch_assoc();
                                    ?>
                                                <div class="col-12 mb-3">
                                                    <div class="card">
                                                        <div class="row g-0">
                                                            <div class="col-md-4">
                                                                <img src="<?php echo($productImg["img_path"]);?>" class="img-fluid rounded-start" style="height: 200px;" />
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="card-body">
                                                                    <h5 class="card-title fs-2 fw-bold text-primary"><?php echo ($watchListData["title"]); ?></h5>
                                                                    <span class="fs-5 fw-bold text-black-50">Colour : <?php echo ($watchListData["color"]); ?></span>
                                                                    &nbsp;&nbsp; | &nbsp;&nbsp;
                                                                    <span class="fs-5 fw-bold text-black-50">Condition : <?php echo ($watchListData["condition"]); ?></span>
                                                                    <br />
                                                                    <span class="fs-5 fw-bold text-black-50">Price :</span>&nbsp;&nbsp;
                                                                    <span class="fs-5 fw-bold text-black">Rs. <?php echo ($watchListData["price"]); ?> .00</span>
                                                                    <br />
                                                                    <span class="fs-5 fw-bold text-black-50">Quantity :</span>&nbsp;&nbsp;
                                                                    <span class="fs-5 fw-bold text-black"><?php echo ($watchListData["qty"]); ?> Items available</span>
                                                                    <br />
                                                                    <span class="fs-5 fw-bold text-black-50">Seller :</span>
                                                                    <br />
                                                                    <span class="fs-5 fw-bold text-black"><?php echo ($watchListData["fname"]); ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 mt-5">
                                                                <div class="card-body d-lg-grid">
                                                                    <a href="#" class="btn btn-outline-success mb-2">Buy Now</a>
                                                                    <a href="#" class="btn btn-outline-warning mb-2">Add to Cart</a>
                                                                    <a onclick="removeFromWatchList(<?php echo ($watchListData['watch_id']); ?>);" class="btn btn-outline-danger">Remove</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                            <?php include "footer.php"; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
