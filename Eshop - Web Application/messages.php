<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Messages | eShop</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <link rel="icon" href="resources/logo.svg" />
</head>

<body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">

    <div class="container-fluid">
        <div class="row">
            <?php
            include "header.php";
            include "connection.php";

            $receiver = $_SESSION["u"]["email"];

            if (isset($_GET["id"])) {
                $sender = $_GET["id"];
            }  

            $msgRS = Database::search("SELECT * FROM `chat` WHERE `from` = '" . $sender . "' AND `to` = '" . $receiver . "' OR `from` = '" . $receiver . "' AND `to` = '" . $sender . "'");
            $msgCount = $msgRS->num_rows;

            if ($msgCount == 0) {
            ?>
                <!-- modal -->
                <div class="modal" tabindex="-1" id="chatModal<?php echo ($sender); ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Start a New Chat</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <label for="" class="form-label">To: </label>
                                    <input type="email" class="form-control" id="r" value="<?php echo($sender);?>"/>
                                </div>
                                <div class="col-12">
                                    <label for="">Message</label>
                                    <textarea rows="8" class="form-control" name="" id="msg"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="">Sent Message</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->

                <script>
                    openChat('<?php echo($sender);?>');
                </script>


            <?php
            } else {
                for ($i = 0; $i < $msgCount; $i++) {
                    $msgData = $msgRS->fetch_assoc();
                }
            }



            ?>

            <div class="col-12">
                <hr />
            </div>

            <div class="col-12 py-5 px-4">
                <div class="row overflow-hidden shadow rounded">
                    <div class="col-12 col-lg-5 px-0">
                        <div class="bg-white">
                            <div class="bg-light px-4 py-2">
                                <div class="col-12">
                                    <h5 class="mb-0 py-1">Recents</h5>
                                </div>
                                <div class="col-12">

                                    <!--  -->
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Received</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Sent</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="message_box" id="message_box">

                                                <div class="list-group rounded-0">
                                                    <a href="#" class="list-group-item list-group-item-action text-white rounded-0 bg-primary">

                                                        <div class="media">

                                                            <img src="resources/new_user.svg" width="50px" class="rounded-circle">

                                                            <div class="me-4">
                                                                <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                    <h6 class="mb-0 fw-bold">Sahan</h6>
                                                                    <small class="small fw-bold">2023-12-30 08:30:40</small>

                                                                </div>
                                                                <p class="mb-0">Hello</p>
                                                            </div>
                                                        </div>
                                                    </a>

                                                </div>

                                                <div class="list-group rounded-0">
                                                    <a href="#" class="list-group-item list-group-item-action text-dark rounded-0 bg-body">

                                                        <div class="media">

                                                            <img src="resources/new_user.svg" width="50px" class="rounded-circle">

                                                            <div class="me-4">
                                                                <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                    <h6 class="mb-0 fw-bold">Janith</h6>
                                                                    <small class="small fw-bold">2023-12-30 08:35:40</small>

                                                                </div>
                                                                <p class="mb-0">Hey</p>
                                                            </div>
                                                        </div>
                                                    </a>

                                                </div>


                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                            <div class="message_box" id="message_box">

                                                <div class="list-group rounded-0">
                                                    <a href="#" class="list-group-item list-group-item-action text-black rounded-0 bg-secondary">
                                                        <div class="media">

                                                            <img src="resources/new_user.svg" width="50px" class="rounded-circle">

                                                            <div class="me-4">
                                                                <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                    <h6 class="mb-0 fw-bold"> me</h6>
                                                                    <small class="small fw-bold">2023-12-30 08:30:40</small>

                                                                </div>
                                                                <p class="mb-0">Good Morning</p>
                                                            </div>
                                                        </div>
                                                    </a>

                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                    <!--  -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-7 px-0">
                        <div class="row px-4 py-5 text-white chat_box" id="chat_box">

                            <!-- view area -->
                            <!-- received -->
                            <div class="media w-75">
                                <img src="resources/new_user.svg" width="50px" class="rounded-circle mb-2" alt="">
                                <div class="media-body">
                                    <div class="bg-light rounded py-2 px-3 mb-3">
                                        <p class="mb-0 fw-bold text-black-50">Hello</p>
                                    </div>
                                    <p class="small fw-bold text-white-50 text-end">2024-08-28 17.00.00</p>
                                </div>
                            </div>

                            <!-- received -->
                            <!-- sent -->
                            <div class="offset-3 col-9 media w-75 text-end justify-content-end align-items end">
                                <div class="media-body">
                                    <div class="bg-primary rounded py-2 px-3 mb-3">
                                        <p class="mb-0 fw-bold text-white-50">Hello</p>
                                    </div>
                                    <p class="small fw-bold text-white-50 text-end">2024-08-28 17.00.00</p>
                                </div>
                            </div>
                            <!-- sent -->




                        </div>
                        <!-- txt -->
                        <div class="col-12 px-2">
                            <div class="row">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control rounded border-0 py-3 bg-light" placeholder="Type a message ..." aria-describedby="send_btn" id="msg_txt" />
                                    <button class="btn btn-light fs-2" id="send_btn"><i class="bi bi-send-fill fs-1"></i></button>
                                </div>
                            </div>
                        </div>
                        <!-- txt -->
                    </div>

                </div>
            </div>

            <?php include "footer.php"; ?>
        </div>
    </div>

    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
   
</body>

</html>