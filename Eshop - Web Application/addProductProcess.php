<?php
session_start();
include("connection.php");

$email = $_SESSION["u"]["email"];
$category = $_POST["cat"];
$brand = $_POST["brand"];
$model = $_POST["model"];
$title = $_POST["title"];
$condition = $_POST["condition"];
$color = $_POST["color"];
$qty = $_POST["qty"];
$price = $_POST["price"];
$deliveryColombo = $_POST["dcol"];
$deliveryOther = $_POST["do"];
$description = $_POST["pdes"];

// Input Field Validations
if (empty($category) || $category == 0) {
    echo ("Please Select a Category");
} else if (empty($brand) || $brand == 0) {
    echo ("Please Select a Brand");
} else if (empty($model) || $model == 0) {
    echo ("Please Select a Model");
} else if (empty($title)) {
    echo ("Please Enter a Title for your Product");
} else if (empty($condition)) {
    echo ("Please Select the Condition of your Product");
} else if (empty($color) || $color == 0) {
    echo ("Please Select a Color. If your product does not have a color, please select N/A");
} else if (empty($qty)) {
    echo ("Please Enter the available quantity of your product");
} else if (empty($price)) {
    echo ("Please Enter the price of the product");
} else if (empty($deliveryColombo)) {
    echo ("Please Enter the delivery fee within Colombo");
} else if (empty($deliveryOther)) {
    echo ("Please Enter the delivery fee outside of Colombo");
} else if (empty($description)) {
    echo ("Please Enter a Product Description");
} else {
    // Model - Brand Insertion or Selection
    $modelHasBrandResultSet = Database::search("SELECT * FROM `model_has_brand` WHERE `model_id` = '" . $model . "' AND `brand_id` = '" . $brand . "'");
    $modelHasBrandCount = $modelHasBrandResultSet->num_rows;
    if ($modelHasBrandCount > 0) {
        $modelHasBrandData = $modelHasBrandResultSet->fetch_assoc();
        $modelHasBrandId = $modelHasBrandData["model_has_brand"];
    } else {
        Database::iud("INSERT INTO `model_has_brand` (`model_id`, `brand_id`) VALUES ('" . $model . "', '" . $brand . "')");
        $modelHasBrandId = Database::$connection->insert_id;
    }

    // Setting DateTime
    $dateTime = new DateTime();
    $timeZone = new DateTimeZone("Asia/Colombo");
    $dateTime->setTimezone($timeZone);
    $dateTimeFormat = $dateTime->format("Y-m-d H:i:s");

    $statusId = 1;

    // Inserting Details into `product` table
    Database::iud("INSERT INTO `product` (`title`, `price`, `description`, `qty`, `datetime_added`, `delivery_fee_colombo`, `delivery_fee_other`, `status_status_id`, `condition_id`, `category_id`, `model_has_brand`, `color_id`, `user_email`) 
    VALUES ('" . $title . "', '" . $price . "', '" . $description . "', '" . $qty . "', '" . $dateTimeFormat . "', '" . $deliveryColombo . "', '" . $deliveryOther . "', '" . $statusId . "', '" . $condition . "', '" . $category . "', '" . $modelHasBrandId . "', '" . $color . "', '" . $email . "')");

    $productId = Database::$connection->insert_id;

    $fileCount = sizeof($_FILES);

    if ($fileCount <= 3 && $fileCount > 0) {
        $allowedImgExtensions = array("image/jpeg", "image/png", "image/svg+xml");
        for ($i = 0; $i < $fileCount; $i++) {
            if (isset($_FILES["i" . $i])) {
                $productImg = $_FILES["i" . $i];
                $productImgExtension = $productImg["type"];

                if (in_array($productImgExtension, $allowedImgExtensions)) {
                    $newExtension;

                    if ($productImgExtension == "image/jpeg") {
                        $newExtension = ".jpeg";
                    } else if ($productImgExtension == "image/png") {
                        $newExtension = ".png";
                    } else if ($productImgExtension == "image/svg+xml") {
                        $newExtension = ".svg";
                    }

                    $productFileName = "resources//product_images//" . $productId . $title . uniqid() . $newExtension;

                    move_uploaded_file($productImg["tmp_name"], $productFileName);

                    Database::iud("INSERT INTO `product_img` (`img_path`, `product_id`) VALUES ('" . $productFileName . "', '" . $productId . "')");
                    echo ("Success");
                } else {
                    echo ("The file type you selected is not supported. Please upload JPEG, SVG or PNG images");
                }
            }
        }
    } else {
        echo ("You have not selected any Images");
    }
}
