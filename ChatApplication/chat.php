<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat App</title>
    <link href="bootstrap.css" rel="stylesheet">
    <style>
        .chat-body {
            flex: 1;
            padding: 10px;
            overflow-y: auto;

        }

        .message {
            margin-bottom: 15px;
            max-width: 70%;
            padding: 10px;
            position: relative;
        }

        .message.sent {
            border-bottom-right-radius: 0;
        }

        .message.received {
            border-bottom-left-radius: 0;
        }


        .chat-footer input {
            border-radius: 20px;
        }
    </style>
</head>

<body onload="y();" >

    <div class="container">

        <div class="col-8 offset-2 mt-5">
            <select class="form-select" id="receiver">


                <?php

                session_start();

                $connection = new mysqli("localhost", "root", "...", "test", "3306");

                if ($connection->connect_error) {
                    echo ("Connection Failed");
                } else {

                    $q = "SELECT * FROM `user`";

                    $result = $connection->query($q);

                    $row_count = $result->num_rows;

                    for ($i = 0; $i < $row_count; $i++) {
                        $data = $result->fetch_assoc();

                        $all_id = $data["id"];
                        $all_names = $data["fname"];

                        if ($all_id != $_SESSION["u"]["id"]) {
                            ?>
                               <option value="<?php echo($all_id)?>" ><?php echo($all_names)?></option>
                            <?php
                        }

                    }
                }

                ?>
                

            </select>
        </div>

        <div class="card mt-5">
            <div class="chat-body bg-info d-flex flex-column" id="msgbox">
  
            </div>


            <div class="p-2 bg-dark d-block">
                <input id="msg" style="font-family:Uni Sans CAPS;" type="text" class="form-control col-2 flex-1 p-3" placeholder="Type a message" />
                <button style="font-family:Uni Sans CAPS;" class="btn btn-success text-light col-3 ml-5 mt-1" onclick="send();">
                    Send
                </button>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="script.js"></script>
</body>

</html>
