<?php
include("connection.php");

$searchTxt = $_POST["t"];
$category = $_POST["cat"];
$brand = $_POST["b"];
$model = $_POST["m"];
$condition = $_POST["c"];
$color = $_POST["color"];
$priceFrom = $_POST["pf"];
$priceTo = $_POST["pt"];
$sort = $_POST["sort"]; // 0, 1, 2, 3, 4

$productQ = "SELECT * FROM `product` ";
$status = 0;

if (!empty($searchTxt)) {
    $productQ .= "WHERE `title` LIKE '%" . $searchTxt . "%'";
    $status = 1;
}

if ($category != 0 && $status == 0) {
    $productQ .= "WHERE `category_id` = '" . $category . "'";
} else if ($category != 0 && $status != 0) {
    $productQ .= " AND `category_id` = '" . $category . "'";
}

$pid = 0;
if ($brand != 0 && $model == 0) {
    $mhbResultSet = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_id` = '" . $brand . "'");
    for ($y = 0; $y < $mhbResultSet->num_rows; $y++) {
        $mhbData = $mhbResultSet->fetch_assoc();
        $pid = $mhbData["model_has_brand"];
    }

    if ($status == 0) {
        $productQ .= "WHERE `product`.`model_has_brand` = '" . $pid . "'";
        $status = 1;
    } else if ($status != 0) {
        $productQ .= "AND `product`.`model_has_brand` = '" . $pid . "'";
    }
} else if ($brand == 0 && $model != 0) {
    $mhbResultSet = Database::search("SELECT * FROM `model_has_brand` WHERE `model_id` = '" . $model . "'");
    for ($y = 0; $y < $mhbResultSet->num_rows; $y++) {
        $mhbData = $mhbResultSet->fetch_assoc();
        $pid = $mhbData["model_has_brand"];
    }

    if ($status == 0) {
        $productQ .= "WHERE `product`.`model_has_brand` = '" . $pid . "'";
        $status = 1;
    } else if ($status != 0) {
        $productQ .= "AND `product`.`model_has_brand` = '" . $pid . "'";
    }
} else if ($brand != 0 && $model != 0) {
    $mhbResultSet = Database::search("SELECT * FROM `model_has_brand` WHERE `model_id` = '" . $model . "' AND `brand_id` = '" . $brand . "'");
    for ($y = 0; $y < $mhbResultSet->num_rows; $y++) {
        $mhbData = $mhbResultSet->fetch_assoc();
        $pid = $mhbData["model_has_brand"];
    }

    if ($status == 0) {
        $productQ .= "WHERE `product`.`model_has_brand` = '" . $pid . "'";
        $status = 1;
    } else if ($status != 0) {
        $productQ .= "AND `product`.`model_has_brand` = '" . $pid . "'";
    }
}

if ($condition != 0 && $status == 0) {
    $productQ .= " WHERE `condition_id` = '" . $condition . "'";
    $status = 1;
} else if ($condition != 0 && $status != 0) {
    $productQ .= " AND `condition_id` = '" . $condition . "'";
}

if ($color != 0 && $status == 0) {
    $productQ .= " WHERE `color_id` = '" . $color . "'";
    $status = 1;
} else if ($color != 0 && $status != 0) {
    $productQ .= " AND `color_id` = '" . $color . "'";
}

if (!empty($priceFrom) && empty($priceTo)) {
    if ($status == 0) {
        $productQ .= " WHERE `price` >= '" . $priceFrom . "'";
        $status = 1;
    } else if ($status != 0) {
        $productQ .= " AND `price` >= '" . $priceFrom . "'";
    }
} else if (empty($priceFrom) && !empty($priceTo)) {
    if ($status == 0) {
        $productQ .= " WHERE `price` <= '" . $priceTo . "'";
        $status = 1;
    } else if ($status != 0) {
        $productQ .= " AND `price` <= '" . $priceTo . "'";
    }
} else if (!empty($priceFrom) && !empty($priceTo)) {
    if ($status == 0) {
        $productQ .= " WHERE `price` BETWEEN '" . $priceFrom . "' AND '" . $priceTo . "'";
        $status = 1;
    } else if ($status != 0) {
        $productQ .= " AND `price` BETWEEN '" . $priceFrom . "' AND '" . $priceTo . "'";
    }
}


if ($sort == "0") {
    $searchQuery = $productQ;
} else if ($sort == "1") {
    //Price Low to High
    $searchQuery = $productQ." ORDER BY `price` ASC";
} else if ($sort == "2") {
    //Price High to Low
    $searchQuery = $productQ." ORDER BY `price` DESC";
} else if ($sort == "3") {
    //Qty Low to High
    $searchQuery = $productQ." ORDER BY `qty` ASC";
} else if ($sort == "4") {
    //Qty High to Low
    $searchQuery = $productQ." ORDER BY `qty` DESC";
}

$pageNo;

if ($_POST["page"] == 0) {
    $pageNo = 1;
} else {
    $pageNo = $_POST["page"];
}

$selectedProductResultSet = Database::search($searchQuery);
$selectedProductCount = $selectedProductResultSet->num_rows;

$resultsPerPage = 2;

$pageCountRequired = ceil($selectedProductCount / $resultsPerPage);

$productsToSkip = ($pageNo - 1) * $resultsPerPage;

$finalResultSet = Database::search($searchQuery . " LIMIT " . $resultsPerPage . " OFFSET " . $productsToSkip);
$finalCount = $finalResultSet->num_rows;

for ($x = 0; $x < $finalCount; $x++) {
    $finalData = $finalResultSet->fetch_assoc();
?>

    <div class="card col-6 col-lg-2 mt-4 mb-4 me-5 ms-5" style="width: 18rem;">
        <?php
        $imageResultSet = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $finalData["id"] . "'");
        $imageCount = $imageResultSet->num_rows;
        $imageData = $imageResultSet->fetch_assoc();

        if ($imageCount > 0) {
        ?>
            <img src="<?php echo ($imageData["img_path"]); ?>" class="card-img-top img-thumbnail mt-2" style="height: 180px;" />

        <?php
        } else {
        ?>
            <img src="resources/mobile_images/iphone12.jpg" class="card-img-top img-thumbnail mt-2" style="height: 180px;" />

        <?php
        }

        ?>
        <div class="card-body ms-0 m-0 text-center">
            <h5 class="card-title fw-bold fs-6"><?php echo ($finalData["title"]); ?></h5>
            <?php
            $conditionResultSet = Database::search("SELECT * FROM `condition` WHERE `id` = '" . $finalData["condition_id"] . "'");
            $conditionCount = $conditionResultSet->num_rows;
            if ($conditionCount > 0) {
                $conditionData = $conditionResultSet->fetch_assoc();
            ?>
                <span class="badge rounded-pill text-bg-info"><?php echo ($conditionData["condition"]); ?></span><br />
            <?php
            } else {
            ?>
                <span class="badge rounded-pill text-bg-info"><?php echo ($finalData["condition_id"]); ?></span><br />
            <?php
            }
            ?>
            <span class="card-text text-primary">Rs. <?php echo ($finalData["price"]); ?> .00</span><br />


            <?php
            if ($finalData["qty"] >= 1 && $finalData["qty"] < 3) {
            ?>
                <span class="card-text text-danger fw-bold">Almost gone!</span><br />
                <span class="card-text text-danger fw-bold"><?php echo ($finalData["qty"]); ?> Items Available</span><br /><br />
                <a href='#' class="col-12 btn btn-success">Buy Now</a>

            <?php
            } else if ($finalData["qty"] > 3) {
            ?>
                <span class="card-text text-warning fw-bold">In Stock</span><br />
                <span class="card-text text-success fw-bold"><?php echo ($finalData["qty"]); ?> Items Available</span><br /><br />
                <a href='#' class="col-12 btn btn-success">Buy Now</a>

            <?php
            } else {
            ?>
                <span class="card-text text-danger fw-bold">Out of Stock</span><br />
                <span class="card-text text-danger fw-bold">0 Items Available</span><br /><br />
                <a href='#' class="col-12 btn btn-success disabled">Buy Now</a>


            <?php
            }
            ?>


            <button class="col-12 btn btn-dark mt-2">
                <i class="bi bi-cart-plus-fill text-white fs-5"></i>
            </button>

            <button class="col-12 btn btn-outline-light mt-2">
                <i class="bi bi-heart-fill text-danger fs-5"></i>
            </button>

        </div>
    </div>
<?php
}

?>
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
                    onclick="advancedSearch(<?php echo ($pageNo - 1); ?>);"
                    <?php
                    }
                    ?>
                    aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php
            for ($z = 1; $z <= $pageCountRequired; $z++) {
                if ($pageNo == $z) {
            ?>
                    <li class="page-item active">
                        <a class="page-link" onclick="advancedSearch(<?php echo ($z); ?>);"><?php echo ($z); ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" onclick="advancedSearch(<?php echo ($z); ?>);"><?php echo ($z); ?></a>
                    </li>
            <?php

                }
            }
            ?>

            <li class="page-item">
                <a class="page-link"
                    <?php
                    if ($pageNo >= $pageCountRequired) {
                    ?>
                    disabled
                    <?php
                    } else {
                    ?>
                    onclick="advancedSearch(<?php echo ($pageNo + 1); ?>);"
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
</div>