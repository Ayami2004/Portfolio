<?php
    include("connection.php");
    $brandId = $_GET["b"];
    
    $modelResultSet = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_id` = '".$brandId."';");
    $modelCount = $modelResultSet->num_rows;

    
    ?>
    <option value="0">Select Model</option>
    <?php
    for ($i=0; $i < $modelCount; $i++) { 
        $modelData = $modelResultSet->fetch_assoc();
        $modelNameResultSet = Database::search("SELECT * FROM `model` where `id` = '".$modelData["model_id"]."'");
        $modelName = $modelNameResultSet->fetch_assoc();
        ?> 
        <option value="<?php echo($modelData["model_id"]);?>"><?php echo($modelName["model"]);?></option>
        <?php
    }
?>