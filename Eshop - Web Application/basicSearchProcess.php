<?php
include("connection.php");

$searchKey = $_POST["key"];
$category = $_POST["cat"];

$searchQuery = "SELECT * FROM `product`";
if (!empty($searchKey)) {
    if ($category != 0) {
        $searchQuery .= " WHERE `title` LIKE '%$searchKey%' AND `category_id` = '" . $category . "'";
    } else {
        $searchQuery .= " WHERE `title` LIKE '%$searchKey%'";
    }
} else {
    $searchQuery .= " WHERE `category_id` = '" . $category . "'";
}

$selectedProductResultSet = Database::search($searchQuery);
$selectedProductCount = $selectedProductResultSet->num_rows;
if ($selectedProductCount > 0) {
?>
    <div class="row">
        <div class="offset-lg-1 col-12 col-lg-10 text-center">
            <div class="row">
                <?php
                $pageNo;

                if ($_POST["page"] == 0) {
                    $pageNo = 1;
                } else {
                    $pageNo = $_POST["page"];
                }

                $selectedProductResultSet = Database::search($searchQuery);
                $selectedProductCount = $selectedProductResultSet->num_rows;

                $resultsPerPage = 4;

                $pageCountRequired = ceil($selectedProductCount / $resultsPerPage);

                $productsToSkip = ($pageNo - 1) * $resultsPerPage;

                $finalResultSet = Database::search($searchQuery . " LIMIT " . $resultsPerPage . " OFFSET " . $productsToSkip);
                $finalCount = $finalResultSet->num_rows;

                for ($x = 0; $x < $finalCount; $x++) {
                    $finalData = $finalResultSet->fetch_assoc();
                ?>

                    <div class="card col-6 col-lg-2 mt-2 mb-2" style="width: 18rem;">
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
                                    onclick="basicSearch(<?php echo ($pageNo - 1); ?>);"
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
                                        <a class="page-link" onclick="basicSearch(<?php echo ($z); ?>);"><?php echo ($z); ?></a>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li class="page-item">
                                        <a class="page-link" onclick="basicSearch(<?php echo ($z); ?>);"><?php echo ($z); ?></a>
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
                                    onclick="basicSearch(<?php echo ($pageNo + 1); ?>);"
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
        </div>
    </div>
    </div>

<?php
} else {
    echo ("No Items to Display. Try a different Sorting");
}

?>