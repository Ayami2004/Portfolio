<?php
    include("connection.php");

    $provinceId = $_GET["p"];

    $districtResultSet = Database::search("SELECT * FROM `district` WHERE `province_id` = '".$provinceId."'");

    $districtCount = $districtResultSet->num_rows;

    ?>
    <option value="0">Select District</option>
    <?php
    for ($i=0; $i < $districtCount ; $i++) { 
        $districtData = $districtResultSet->fetch_assoc();
        ?>
            <option value="<?php echo($districtData["id"]);?>"><?php echo($districtData["district"]);?></option>
        <?php
    }
?>