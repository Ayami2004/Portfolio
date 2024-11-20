<?php

session_start();
include("connection.php");

if (isset($_SESSION["u"])) {
    if (isset($_GET["id"])) {
        if (isset($_GET["qty"])) {
            $productId = $_GET["id"];
            $qty = $_GET["qty"];
            $userEmail = $_SESSION["u"]["email"];

            $array = [];

            $order_id = uniqid();

            $productRS = Database::search("SELECT * FROM `product` WHERE `id` = '".$productId."'");
            $productData = $productRS->fetch_assoc();

            $addressRS = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON `user_has_address`.`city_id` = `city`.`id` INNER JOIN `district` ON `district`.`id` = `city`.`district_id` INNER JOIN `province` ON `province`.`id` = `district`.`province_id` WHERE `user_email` = '".$userEmail."'");
            $addressCount = $addressRS->num_rows;

            if ($addressCount == 1) {
                $addressData = $addressRS->fetch_assoc();
                $address = $addressData["line01"].", ".$addressData["line02"];
                $delivery = 0;

                if($addressData["district"] == "Colombo") {
                    $delivery = $productData["delivery_fee_colombo"];
                } else {
                    $delivery = $productData["delivery_fee_other"];
                }

                $item = $productData["title"];
                $amount = ((int)$productData["price"]*(int)$qty) + (int)$delivery;

                $fname = $_SESSION["u"]["fname"];
                $lname = $_SESSION["u"]["lname"];
                $mobile = $_SESSION["u"]["mobile"];
                $city = $addressData["city"];

                $merchant_id = "1227678";
                $merchant_secret = "MjA2Mjk0MDQzNzMxODAzNzM3MjUxNzUwMTQ4MDM0NDgxMTc1MjI5";
                $currency = "LKR";
                $hash = strtoupper(
                    md5(
                        $merchant_id . 
                        $order_id . 
                        number_format($amount, 2, '.', '') . 
                        $currency .  
                        strtoupper(md5($merchant_secret)) 
                    ) 
                );

                $array["id"] = $order_id;
                $array["item"] = $item;
                $array["amount"] = $amount;
                $array["fname"] = $fname;
                $array["lname"] = $lname;
                $array["mobile"] = $mobile;
                $array["address"] = $address;
                $array["city"] = $city;
                $array["umail"] = $userEmail;
                $array["mid"] = $merchant_id;
                $array["msecret"] = $merchant_secret;
                $array["currency"] = $currency;
                $array["hash"] = $hash;

                echo json_encode($array);
                
            } else {
                echo("2");
            }

        }
    }
} else {
    echo("1");
}
?>