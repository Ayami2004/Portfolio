<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update Product | eShop</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/style.css" />

    <link rel="icon" href="resources/logo.svg" />

</head>

<body>

    <div class="container-fluid">
        <div class="row gy-3">

            <?php 
            include "header.php";
            include("connection.php");

            if(isset($_SESSION["u"])) {
                if(isset($_GET["id"])) {
                $productId = $_GET["id"];

                $productResultSet = Database::search("SELECT * FROM `product` INNER JOIN `category` ON `product`.`category_id` = `category`.`id` INNER JOIN `model_has_brand` ON `product`.`model_has_brand`=`model_has_brand`.`model_has_brand` INNER JOIN `model` ON `model_has_brand`.`model_id`=`model`.`id` INNER JOIN `brand` ON `model_has_brand`.`brand_id` = `brand`.`id` INNER JOIN `color` ON `product`.`color_id` = `color`.`id` WHERE `product`.`id` = '".$productId."'");
                $productData = $productResultSet->fetch_assoc();
                ?>
                <div class="col-12">
                        <div class="row">

                            <div class="col-12 text-center">
                                <h2 class="h2 text-primary fw-bold">Update Product</h2>
                            </div>

                            <div class="col-12">
                                <div class="row">

                                <!-- AlertBox - START -->
                                <center>
                                    <div class="col-8 mt-3 d-none" id="msgDivx">
                                        <div class="alert alert-danger" style="height: 5px; font-size: 13px; display: flex; align-items: center;" role="alert" id="msgx"></div>
                                    </div>
                                </center>
                                <!-- AlertBox - END -->
                                    <div class="col-12 col-lg-4 border-end border-success">
                                        <div class="row">

                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Product Category</label>
                                            </div>

                                            <div class="col-12">
                                                <select class="form-select text-center" disabled>
                                                    <option><?php echo($productData["category"]);?></option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4 border-end border-success">
                                        <div class="row">

                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Product Brand</label>
                                            </div>

                                            <div class="col-12">
                                                <select class="form-select text-center" disabled>
                                                    <option><?php echo($productData["brand"]);?></option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4 border-end border-success">
                                        <div class="row">

                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Product Model</label>
                                            </div>

                                            <div class="col-12">
                                                <select class="form-select text-center" disabled>
                                                    <option><?php echo($productData["model"]);?></option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-success" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">
                                                    Product Title
                                                </label>
                                            </div>
                                            <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                <input type="text" id="title" class="form-control" value="<?php echo($productData["title"]);?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-success" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-12 col-lg-4 border-end border-success">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Product Condition</label>
                                                    </div>
                                                        <div class="col-12">
                                                            <div class="form-check form-check-inline mx-5">
                                                                <input class="form-check-input" type="radio" id="b" name="c" 
                                                                <?php 
                                                                    if ($productData["condition_id"] == 1) {
                                                                        ?>
                                                                        checked
                                                                        <?php
                                                                    }
                                                                ?>
                                                                disabled />
                                                                <label class="form-check-label fw-bold" for="b">Brandnew</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="u" name="c" 
                                                                <?php 
                                                                    if ($productData["condition_id"] == 2) {
                                                                        ?>
                                                                        checked
                                                                        <?php
                                                                    }
                                                                ?>
                                                                disabled />
                                                                <label class="form-check-label fw-bold" for="u">Used</label>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-4 border-end border-success">
                                                <div class="row">

                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Product Colour</label>
                                                    </div>

                                                    <div class="col-12">
                                                        <select class="form-select" disabled>
                                                            <option><?php echo($productData["color"]);?></option>
                                                        </select>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="input-group mt-2 mb-2">
                                                            <input type="text" class="form-control" placeholder="Add new Colour" disabled />
                                                            <button class="btn btn-outline-primary" type="button" id="button-addon2" disabled>+ Add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-4">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Product Quantity</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="number" id="qty" class="form-control" min="0" value="<?php echo($productData["qty"]);?>"/>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-success" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-6 border-end border-success">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Cost Per Item</label>
                                                    </div>
                                                    <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input type="text" class="form-control" disabled value="<?php echo($productData["price"]);?>"/>
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Approved Payment Methods</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="offset-0 offset-lg-2 col-2 pm pm1"></div>
                                                            <div class="col-2 pm pm2"></div>
                                                            <div class="col-2 pm pm3"></div>
                                                            <div class="col-2 pm pm4"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-success" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Delivery Cost</label>
                                            </div>
                                            <div class="col-12 col-lg-6 border-end border-success">
                                                <div class="row">
                                                    <div class="col-12 offset-lg-1 col-lg-3">
                                                        <label class="form-label">Delivery cost Within Colombo</label>
                                                    </div>
                                                    <div class="col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input id="dwc" type="text" class="form-control" value="<?php echo($productData["delivery_fee_colombo"]);?>"/>
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="row">
                                                    <div class="col-12 offset-lg-1 col-lg-3">
                                                        <label class="form-label">Delivery cost out of Colombo</label>
                                                    </div>
                                                    <div class="col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input id="doc" type="text" class="form-control" value="<?php echo($productData["delivery_fee_other"]);?>"/>
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-success" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Product Description</label>
                                            </div>
                                            <div class="col-12">
                                                <textarea cols="30" rows="15" class="form-control" id="d"><?php echo($productData["description"]);?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-success" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Add Product Images</label>
                                            </div>
                                            <div class="offset-lg-3 col-12 col-lg-6">

                                            <?php
                                            $img = array();

                                            $img[0] = "resources/addproductimg.svg";
                                            $img[1] = "resources/addproductimg.svg";
                                            $img[2] = "resources/addproductimg.svg";

                                            $imgResultSet = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '".$productId."'");

                                            $imgCount = $imgResultSet->num_rows;

                                            for ($x=0; $x < $imgCount; $x++) { 
                                                $imgData = $imgResultSet->fetch_assoc();
                                                $img[$x] = $imgData["img_path"];
                                            }
                                            ?>

                                                <div class="row">

                                                <!-- AlertBox - START -->
                                <center>
                                    <div class="col-8 mt-3 d-none" id="msgDiv">
                                        <div class="alert alert-success" style="height: 5px; font-size: 13px; display: flex; align-items: center;" role="alert" id="msg"></div>
                                    </div>
                                </center>
                                <!-- AlertBox - END -->
                                                    <div class="col-4 ">
                                                        <img src="<?php echo($img[0]);?>" class="img-fluid" id="img0" style="width: 250px;" />
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="<?php echo($img[1]);?>" class="img-fluid" id="img1" style="width: 250px;" />
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="<?php echo($img[2]);?>" class="img-fluid" id="img2" style="width: 250px;" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                                <input type="file" class="d-none" id="productImg" multiple />
                                                <label for="productImg" class="col-12 btn btn-primary" onclick="displayProductImg();">Upload Images</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-success" />
                                    </div>

                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                        <button class="btn btn-dark" onclick="updateProduct(<?php echo($productId);?>);">Update Product</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                <?php
                } else {
                    echo("Please Select a product to Update");
                }
                
            } else {
                echo("Please Sign In to View Your Products");
            }
            
            ?>

                    
            <?php include "footer.php"; ?>
        </div>
    </div>

    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/script.js"></script>
</body>

</html>