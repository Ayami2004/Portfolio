<?php

session_start();

$user_id = $_SESSION["u"]["id"];
$receiver = $_POST["r"];

$connection = new mysqli("localhost", "root", "V@123Vishwa?", "test", "3306");

if ($connection->connect_error) {
    echo ("Connection Failed");
} else {

    $q = "SELECT * FROM `chat` WHERE `sender` = '" . $user_id . "' OR `reciever` = '" . $user_id . "' 
         AND `sender` = '" . $receiver . "' OR `reciever` = '" . $receiver . "' ";


    $result = $connection->query($q);

    $row_count = $result->num_rows;

    for ($i = 0; $i < $row_count; $i++) {
        $data = $result->fetch_assoc();


        if ($user_id == $data["reciever"]) {
?>
            <?php
               $q2 = "SELECT * FROM `user` WHERE `id` = '".$data["sender"]."'";
               $r2 = $connection->query($q2);
               $data2 = $r2->fetch_assoc();

            ?>

            <!-- Recieved msg -->
            <label class="fw-bold align-self-start "><?php echo $data2["fname"]?></label>
            <div style="font-family:Uni Sans CAPS;" class="message rounded-top-4 rounded-start-0 align-self-start text-dark bg-warning">
               <p><?php echo $data["msg"]?></p>
            </div>

<?php
        }

        if ($user_id == $data["sender"]) {
?>
            <!-- Sent msg -->
            <label class="fw-bold align-self-end">Me</label>
            <div style="font-family:Uni Sans CAPS;" class="message sent message rounded-top-4 rounded-start-0 align-self-end text-light bg-success ">
                 <p><?php echo $data["msg"]?></p>
            </div>
<?php
        }
    }
}
