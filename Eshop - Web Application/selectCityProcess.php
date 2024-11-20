<?php
include("connection.php");
$districtId = $_GET["d"];

$cityResultSet = Database::search("SELECT * FROM `city` WHERE `district_id` = '".$districtId."'");

$cityCount = $cityResultSet->num_rows;


?>
<option value="0">Select City</option>
<?php
for ($i=0; $i < $cityCount; $i++) { 
    $cityData = $cityResultSet->fetch_assoc();
    ?> 
    <option value="<?php echo($cityData["id"]);?>"><?php echo($cityData["city"]);?></option>
    <?php
}
?>