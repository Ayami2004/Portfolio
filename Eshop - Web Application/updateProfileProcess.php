<?php
include("connection.php");

session_start();

$userEmail = $_SESSION["u"]["email"];
$fname = $_POST["fn"];
$lname = $_POST["ln"];
$addressLine01 = $_POST["ad1"];
$addressLine02 = $_POST["ad2"];
$mobile = $_POST["m"];
$city = $_POST["c"];
$postalCode = $_POST["pc"];

$userDetailsResultSet = Database::search("SELECT * FROM `user` WHERE `email` = '" . $userEmail . "'");
if ($userDetailsResultSet->num_rows == 1) {
    // Updating First_Name, Last_Name, Mobile in `user` Table
    $userDetailsData = $userDetailsResultSet->fetch_assoc();
    if ($userDetailsData["fname"] != $fname || $userDetailsData["lname"] != $lname || $userDetailsData["mobile"] != $mobile) {
        Database::iud("UPDATE `user` SET `fname` = '" . $fname . "', `lname` = '" . $lname . "', `mobile` = '" . $mobile . "' WHERE `email` = '" . $userEmail . "'");
        echo("User Updated");
    }

    // Updating Address Details in `user_has_address` Table
    $addressResultSet = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $userEmail . "'");
    $addressCount = $addressResultSet->num_rows;
    if ($addressCount == 1) {
        $addressData = $addressResultSet->fetch_assoc();
        if ($addressData["line01"] != $addressLine01 || $addressData["line02"] != $addressLine02 || $addressData["city_id"] != $city || $addressData["postal_code"] != $postalCode ) {
            Database::iud("UPDATE `user_has_address` SET `line01` = '" . $addressLine01 . "', `line02` = '" . $addressLine02 . "', `city_id` = '" . $city . "', `postal_code` = '".$postalCode."' WHERE `user_email` = '" . $userEmail . "'");
            echo("Address Updated");
        }
        
    } else {
        Database::iud("INSERT INTO `user_has_address` (`user_email`, `city_id`, `line01`, `line02`, `postal_code`) VALUES ('" . $userEmail . "', '" . $city . "', '" . $addressLine01 . "', '" . $addressLine02 . "', '" . $postalCode . "');");
        echo("Address Inserted");
    }

    // Updating Profile Image in `profile_img` Table
    if (sizeof($_FILES) == 1) {
        $profileImg = $_FILES["pi"];
        $imgExtension = $profileImg["type"];

        $allowedImgExtensions = array("image/jpeg", "image/png", "img/svg+xml");

        if (in_array($imgExtension, $allowedImgExtensions)) {

            $newExtension;

            if ($imgExtension == "image/jpeg") {
                $newExtension = ".jpeg";
            } else if ($imgExtension == "image/png") {
                $newExtension = ".png";
            } else if ($imgExtension == "image/svg+xml") {
                $newExtension = ".svg";
            }

            $fileName = "resources//profile_images//" . $fname . "_" . uniqid() . $newExtension;

            move_uploaded_file($profileImg["tmp_name"], $fileName);
            
            $profileImgResultSet = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '".$userEmail."'");
            $profileImgCount = $profileImgResultSet->num_rows;
            if ($profileImgCount == 1) {
                Database::iud("UPDATE `profile_img` SET `img_path` = '".$fileName."' WHERE `user_email` = '".$userEmail."'");
                echo("Image Updated");
            } else {
                Database::iud("INSERT INTO `profile_img` (`img_path`, `user_email`) VALUES ('".$fileName."', '".$userEmail."');");
                echo("Image Inserted");
            }

        } else {
            echo ("The file type you selected is not supported. Please upload a JPEG, PNG, or SVG image");
        }
    } 
    else if (sizeof($_FILES) > 1) {
        echo ("You can only select 1 Image");
    } 
} else {
    echo ("Invalid User");
}
?>