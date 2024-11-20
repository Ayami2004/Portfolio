<?php
    include("connection.php");

    $productId = $_POST["id"];
    $title = $_POST["t"];
    $des = $_POST["d"];
    $dwc = $_POST["dwc"];
    $doc = $_POST["doc"];
    $qty = $_POST["q"];

        if (empty($title)) {
            echo("Please Enter a Title\n");
        } else if (empty($des)) {
            echo("Please Enter a Product Description\n");
        } else if (empty($dwc)) {
            echo("Please Specify the Delivery Fee Within Colombo\n");
        } else if (empty($doc)) {
            echo("Please Specify the Delivey Fee Outside Colombo\n");
        } else if (empty($qty)) {
            echo("Please Enter the Product Quantity\n");
        } else {
            Database::iud("UPDATE `product` SET `title` = '".$title."', `description` = '".$des."', `delivery_fee_colombo` = '".$dwc."', `delivery_fee_other` = '".$doc."', `qty` = '".$qty."' WHERE `id` = '".$productId."'");
            echo("Product has been Updated\n");
        }    
        
    $fileCount = sizeof($_FILES);

    if ($fileCount <= 3 && $fileCount > 0) {
        $allowedImgExtensions = array("image/jpeg", "image/png", "image/svg+xml");

        $imgResultSet = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '".$productId."'");
        $imgCount = $imgResultSet->num_rows;
        
            for ($x=0; $x < $imgCount; $x++) { 
                $imgData = $imgResultSet->fetch_assoc();
                unlink($imgData["img_path"]);
            }

            Database::iud("DELETE FROM `product_img` WHERE `product_id` = '".$productId."'");
        
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
?>