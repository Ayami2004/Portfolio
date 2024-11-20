<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Product | eShop</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/style.css" />

    <link rel="icon" href="resources/logo.svg" />

</head>

<body>

    <div class="container-fluid">
        <div class="row gy-3">
            <?php include "header.php"; ?>

            <div class="col-12 ps-5 pe-5">
                <div class="row">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="fw-bold text-primary">Add New Product</h2>
                    </div>
                    <!-- AlertBox - START -->
                    <div class="col-8 mt-3 d-none" id="msgDivW">
                        <div class="alert alert-danger" style="height: 5px; font-size: 13px; display: flex; align-items: center;" role="alert" id="msgW"></div>
                    </div>
                    <!-- AlertBox - END -->

                    <div class="col-12">
                        <div class="row">

                            <div class="col-12 col-lg-4 border-end border-end-0 border-success">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fw-bold" style="font-size: 20px;">Select Product Category</label>
                                    </div>

                                    <div class="col-12">
                                        <select class="form-select" id="category">
                                            <option value="0">Select Category</option>
                                            <?php
                                            include("connection.php");

                                            $categoryResultSet = Database::search("SELECT * FROM `category`;");
                                            $categoryCount = $categoryResultSet->num_rows;

                                            for ($i = 0; $i < $categoryCount; $i++) {
                                                $categoryData = $categoryResultSet->fetch_assoc();
                                            ?>
                                                <option value="<?php echo ($categoryData["id"]); ?>"><?php echo ($categoryData["category"]); ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 col-lg-4 border-end border-success">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fw-bold" style="font-size: 20px;">Select Product Brand</label>
                                    </div>

                                    <div class="col-12">
                                        <select class="form-select" id="brand" onchange="selectModel();">
                                            <option value="0">Select Brand</option>
                                            <?php
                                            $brandResultSet = Database::search("SELECT * FROM `brand`;");
                                            $brandCount = $brandResultSet->num_rows;

                                            for ($x = 0; $x < $brandCount; $x++) {
                                                $brandData = $brandResultSet->fetch_assoc();
                                            ?>
                                                <option value="<?php echo ($brandData["id"]); ?>"><?php echo ($brandData["brand"]); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 col-lg-4 border-end border-success">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fw-bold" style="font-size: 20px;">Select Product Model</label>
                                    </div>

                                    <div class="col-12">
                                        <select class="form-select" id="model">
                                            <option value="0">Select Model</option>
                                            <?php
                                            $modelResultSet = Database::search("SELECT * FROM `model`;");
                                            $modelCount = $modelResultSet->num_rows;

                                            for ($y = 0; $y < $modelCount; $y++) {
                                                $modelData = $modelResultSet->fetch_assoc();
                                            ?>
                                                <option value="<?php echo ($modelData["id"]); ?>"><?php echo ($modelData["model"]); ?></option>
                                            <?php
                                            }
                                            ?>
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
                                            Add a Title to your Product
                                        </label>
                                    </div>
                                    <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                        <input type="text" id="title" class="form-control" />
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
                                                <label class="form-label fw-bold" style="font-size: 20px;">Select Product Condition</label>
                                            </div>
                                            <div class="col-12">

                                                <div class="form-check mx-5">
                                                    <input class="form-check-input" id="new" name="condition" type="radio" />
                                                    <label class="form-check-label fw-bold" for="new">Brand New</label>
                                                </div>

                                                <div class="form-check mx-5">
                                                    <input class="form-check-input" id="used" name="condition" type="radio" />
                                                    <label class="form-check-label fw-bold" for="used">Used</label>
                                                </div>

                                                <div class="form-check mx-5">
                                                    <input class="form-check-input" id="refurbished" name="condition" type="radio" />
                                                    <label class="form-check-label fw-bold" for="refurbished">Refurbished</label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4 border-end border-success">
                                        <div class="row">

                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Select Product Colour</label>
                                            </div>

                                            <div class="col-12">

                                                <select class="col-12 form-select" id="color">
                                                    <option value="0">Select Colour</option>
                                                    <?php
                                                    $colorResultSet = Database::search("SELECT * FROM `color`;");
                                                    $colorCount = $colorResultSet->num_rows;
                                                    for ($z = 0; $z < $colorCount; $z++) {
                                                        $colorData = $colorResultSet->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo ($colorData["id"]); ?>"><?php echo ($colorData["color"]); ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>

                                            </div>

                                            <div class="col-12">
                                                <!-- AlertBox - START -->
                                                <div class="col-12 mt-3 d-none" id="msgDiv">
                                                    <div class="alert alert-danger" style="height: 5px; font-size: 13px; display: flex; align-items: center;" role="alert" id="msg"></div>
                                                </div>
                                                <!-- AlertBox - END -->
                                                <br />
                                                <p style="font-size: 13px;" class="mb-0 ms-2 fst-italic">If the color of your product does not exist, add it below.</p>
                                                <div class="input-group mt-2 mb-2">

                                                    <input type="text" class="form-control" id="colorInput" placeholder="Add new Colour" />
                                                    <button class="btn btn-outline-primary" type="button" onclick="addColor();">+ Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Add Product Quantity</label>
                                            </div>
                                            <div class="col-12">
                                                <input type="number" id="qty" class="form-control" value="0" min="0" />
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
                                                    <input type="text" id="price" class="form-control" />
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
                                                    <input type="text" id="dcolombo" class="form-control" />
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
                                                    <input type="text" id="dother" class="form-control" />
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
                                        <textarea cols="30" id="pdes" rows="15" class="form-control"></textarea>
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
                                        <!-- AlertBox - START -->
                                        <div class="col-12 mt-3 d-none" id="msgDivImg">
                                            <div class="alert alert-danger" style="height: 5px; font-size: 13px; display: flex; align-items: center;" role="alert" id="msgImg"></div>
                                        </div>
                                        <!-- AlertBox - END -->
                                        <div class="row">
                                            <div class="col-4 rounded">
                                                <img src="resources/addproductimg.svg" id="img0" class="img-thumbnail" style="width: 250px;" />
                                            </div>
                                            <div class="col-4 rounded">
                                                <img src="resources/addproductimg.svg" id="img1" class="img-thumbnail" style="width: 250px;" />
                                            </div>
                                            <div class="col-4 rounded">
                                                <img src="resources/addproductimg.svg" id="img2" class="img-thumbnail" style="width: 250px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                        <input type="file" id="productImg" class="d-none" multiple />
                                        <label for="productImg" class="col-12 btn btn-primary" onclick="displayProductImg();">Upload Images</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="border-success" />
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold" style="font-size: 20px;">Notice...</label><br />
                                <label class="form-label">
                                    We are charging a 5% service fee on the price of every product.
                                </label>
                            </div>

                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                <button class="btn btn-success" onclick="saveProduct();">Save Product</button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <?php include "footer.php"; ?>
        </div>
    </div>

    <script src="js/bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/script.js"></script>
</body>

</html>