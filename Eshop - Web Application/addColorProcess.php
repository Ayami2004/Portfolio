<?php
   include("connection.php");
   $color = $_GET["c"];

   if (empty(trim($color))) {
        echo("Please Enter a Color");
   } else {
        $colorResultSet = Database::search("SELECT * FROM `color` where `color` = '".$color."';");
        $colorCount = $colorResultSet->num_rows;

        if ($colorCount > 0) {
            echo("The Color You Entered Already Exists");
        } else {
            Database::iud("INSERT INTO `color` (`color`) VALUES ('".$color."');");
            echo("Success");
        }
        
   }

?>