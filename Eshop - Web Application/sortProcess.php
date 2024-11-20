<?php
session_start();
include("connection.php");

$userEmail = $_SESSION["u"]["email"];

$search = $_POST["s"];
$condition = $_POST["c"];
$time = $_POST["t"];
$qty = $_POST["q"];

$query = "SELECT * FROM `product` WHERE `user_email` = '" . $userEmail . "'";

if (!empty($search)) {
    $query .= " AND `title` LIKE '%" . $search . "%'";
}

if ($condition != "0") {
    $query .= " AND `condition_id` = '" . $condition . "'";
}

if ($time != "0") {
    if ($time == "1") {
        $query .= " ORDER BY `datetime_added` DESC";
    } else if ($time == "2") {
        $query .= " ORDER BY `datetime_added` ASC";
    }
}

if ($time != "0" && $qty != "0") {
    if ($qty == "1") {
        $query .= " , `qty` DESC";
    } else if ($qty == "2") {
        $query .= " , `qty` ASC";
    }
} else if ($time == "0" && $qty != "0") {
    if ($qty == "1") {
        $query .= " ORDER BY `qty` DESC";
    } else if ($qty == "2") {
        $query .= " ORDER BY `qty` ASC";
    }
}

?>

<div class="offset-1 col-10 text-center">
    <div class="row justify-content-center">

        <?php
        if (0 != $_POST["page"]) {
            $pageNo = $_POST["page"];
        } else {
            $pageNo = 1;
        }

        $productResultSet = Database::search($query);

        $productCount = $productResultSet->num_rows;

        $productsPerPage = 4;

        $pagesReq = ceil($productCount / $productsPerPage);

        $productsToSkip = ($pageNo - 1) * $productsPerPage;

        $productDisplay = Database::search($query . " LIMIT " . $productsPerPage . " OFFSET " . $productsToSkip);

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
                                                <button class="btn btn-success fw-bold">Update</button>
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
            echo ("No Products Available");
        }
        ?>

    </div>
</div>


<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a class="page-link"
                    <?php
                    if ($pageNo <= 1) {
                        ?>
                            disabled
                        <?php
                    } else {
                        ?> 
                            onclick="sort01(<?php echo($pageNo - 1);?>);"
                        <?php
                    }
                    ?>
                         aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php
            for ($z = 1; $z <= $pagesReq; $z++) {
                if ($pageNo == $z) {
            ?>
                    <li class="page-item active">
                        <a class="page-link" onclick="sort01(<?php echo($z);?>);"><?php echo ($z); ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" onclick="sort01(<?php echo($z);?>);"><?php echo ($z); ?></a>
                    </li>
            <?php

                }
            }
            ?>

            <li class="page-item">
                <a class="page-link"
                                                <?php
                                                if ($pageNo >= $pagesReq) {
                                                    ?>
                                                    disabled
                                                   <?php
                                                } else {
                                                    ?>
                                                        onclick="sort01(<?php echo($pageNo + 1);?>);"
                                                    <?php
                                                }
                                                ?>
                                                 aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>