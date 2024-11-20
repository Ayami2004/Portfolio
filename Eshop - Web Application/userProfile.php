<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Profile | eShop</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css" />

    <link rel="icon" href="resources/logo.svg" />

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php
            include "header.php";
            include("connection.php");

            if (isset($_SESSION["u"])) {
                $userEmail = $_SESSION["u"]["email"];
                $userResultSet = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON `user`.`gender_id` = `gender`.`gender_id` WHERE `email` = '" . $userEmail . "';");
                $addressResultSet = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON `user_has_address`.`city_id` = `city`.`id` INNER JOIN `district` ON `district`.`id` = `city`.`district_id` INNER JOIN `province` ON `district`.`province_id` = `province`.`id` WHERE `user_email`='" . $userEmail . "';");
                $profileImgResultSet = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $userEmail . "';");

                $userResultData = $userResultSet->fetch_assoc();
                $profileImgResultData = $profileImgResultSet->fetch_assoc();
                $addressResultData = $addressResultSet->fetch_assoc();

            ?>
                <div class="col-12 bg-primary">
                    <div class="row">

                        <div class="col-12 bg-body rounded mt-4 mb-4">
                            <div class="row g-2">

                                <div class="col-md-3 border-none">

                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                        <?php
                                        if (!empty($profileImgResultData["img_path"])) {
                                        ?>
                                            <img id="pImg" src="<?php echo ($profileImgResultData["img_path"]); ?>" class="rounded mt-5" style="width: 150px;" />
                                        <?php
                                        } else {
                                        ?>
                                            <img id="pImg" src="resources/new_user.svg" class="rounded mt-5" style="width: 150px;" />
                                        <?php
                                        }
                                        ?><br/>
                                        <span class="fw-bold"><?php echo ($userResultData["fname"] . " " . $userResultData["lname"]); ?></span>
                                        <span class="fw-bold text-black-50"><?php echo ($userResultData["email"]); ?></span>

                                        <input type="file" class="d-none" id="profileImg" />
                                        <label for="profileImg" class="btn btn-primary mt-3" onclick="displayProfileImg();">Upload Profile Image</label>

                                    </div>
                                </div>

                                <div class="col-md-6 border mt-4 mb-4">
                                    <div class="p-5 py-5">

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="fw-bold">Profile Settings</h4>
                                        </div>

                                        <!-- AlertBox - START -->
                                        <div class="col-12 d-none" id="msgDiv">
                                            <div class="alert alert-danger" style="height: 5px; font-size: 13px; display: flex; align-items: center;" role="alert" id="msg"></div>
                                        </div>
                                        <!-- AlertBox - END -->

                                        <div class="row mt-4">

                                            <div class="col-6 mb-3">
                                                <label for="fname" class="form-label mb-0">First Name</label>
                                                <input id="fname" type="text" class="form-control" value="<?php echo ($userResultData["fname"]) ?>" />
                                            </div>

                                            <div class="col-6 mb-3">
                                                <label for="lname" class="form-label mb-0">Last Name</label>
                                                <input id="lname" type="text" class="form-control" value="<?php echo ($userResultData["lname"]) ?>" />
                                            </div>

                                            <div class="col-12 mb-3">
                                                <label for="mobile" class="form-label mb-0">Mobile</label>
                                                <input id="mobile" type="text" class="form-control" value="<?php echo ($userResultData["mobile"]) ?>" />
                                            </div>

                                            <div class="col-12 mb-3">
                                                <label class="form-label mb-0">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="pw" value="<?php echo ($userResultData["password"]) ?>" readonly />
                                                    <button type="button" class="btn btn-primary" onclick="showPasswordUserProfile();"><i id="showIcon" class="bi bi-eye-slash-fill"></i></button>

                                                </div>
                                            </div>

                                            <div class="col-12 mb-3">
                                                <label class="form-label mb-0">Email</label>
                                                <input type="text" class="form-control" readonly value="<?php echo ($userResultData["email"]) ?>" />
                                            </div>

                                            <div class="col-12 mb-3">
                                                <label class="form-label mb-0">Registered Date</label>
                                                <input type="text" class="form-control" readonly value="<?php echo ($userResultData["joined_date"]) ?>" />
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="add01" class="form-label mb-0">Address Line 01</label>
                                                <?php
                                                if (empty($addressResultData["line01"])) {
                                                ?><input id="add01" type="text" class="form-control" placeholder="Enter Address Line 01" /><?php
                                                                                                                                        } else {
                                                                                                                                            ?>
                                                    <input id="add01" type="text" class="form-control" value="<?php echo ($addressResultData["line01"]); ?>" />

                                                <?php
                                                                                                                                        }
                                                ?>
                                            </div>

                                            <div class="col-12 mb-3">
                                                <label for="add02" class="form-label mb-0">Address Line 02</label>
                                                <?php
                                                if (empty($addressResultData["line02"])) {
                                                ?><input id="add02" type="text" class="form-control" placeholder="Enter Address Line 02" /><?php
                                                                                                                                        } else {
                                                                                                                                            ?>
                                                    <input id="add02" type="text" class="form-control" value="<?php echo ($addressResultData["line02"]); ?>" />

                                                <?php
                                                                                                                                        }
                                                ?>
                                            </div>

                                            <div class="col-6 mb-3">
                                                <label class="form-label mb-0">Province</label>
                                                <select class="form-select" onchange="selectDistrict();" id="provinceSelector">
                                                    <option value="0">Select Province</option>
                                                    <?php
                                                    $provinceResultSet = Database::search("SELECT * FROM `province`;");
                                                    $provinceCount = $provinceResultSet->num_rows;
                                                    for ($x = 0; $x < $provinceCount; $x++) {
                                                        $provinceResultData = $provinceResultSet->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo ($provinceResultData["id"]); ?>" <?php
                                                                                                                    if (!empty($addressResultData["province_id"])) {
                                                                                                                        if ($provinceResultData["id"] == $addressResultData["province_id"]) {
                                                                                                                    ?> selected <?php
                                                                                                                        }
                                                                                                                    }
                                                                                ?>>
                                                            <?php echo ($provinceResultData["province"]); ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-6 mb-3">
                                                <label class="form-label mb-0">District</label>
                                                <select class="form-select" onchange="selectCity();" id="districtSelector">
                                                    <option value="0">Select District</option>
                                                    <?php
                                                    $districtResultSet = Database::search("SELECT * FROM `district`;");
                                                    $districtCount = $districtResultSet->num_rows;
                                                    for ($y = 0; $y < $districtCount; $y++) {
                                                        $districtResultData = $districtResultSet->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo ($districtResultData["id"]); ?>" <?php
                                                                                                                    if (!empty($addressResultData["district_id"])) {
                                                                                                                        if ($districtResultData["id"] == $addressResultData["district_id"]) {
                                                                                                                    ?> selected <?php
                                                                                                                        }
                                                                                                                    }
                                                                                ?>><?php echo ($districtResultData["district"]); ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-6 mb-3">
                                                <label class="form-label mb-0">City</label>
                                                <select class="form-select" id="citySelector">
                                                    <option value="0">Select City</option>
                                                    <?php
                                                    $cityResultSet = Database::search("SELECT * FROM `city`;");
                                                    $cityCount = $cityResultSet->num_rows;
                                                    for ($z = 0; $z < $cityCount; $z++) {
                                                        $cityResultData = $cityResultSet->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo ($cityResultData["id"]); ?>" <?php
                                                                                                                if (!empty($addressResultData["city_id"])) {
                                                                                                                    if ($cityResultData["id"] == $addressResultData["city_id"]) {
                                                                                                                ?> selected <?php
                                                                                                                    }
                                                                                                                }
                                                                                ?>><?php echo ($cityResultData["city"]); ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-6 mb-3">
                                                <label for="pcode" class="form-label mb-0">Postal Code</label>
                                                <?php
                                                if (empty($addressResultData["postal_code"])) {
                                                ?><input id="pcode" type="text" class="form-control" placeholder="Enter Postal Code" /><?php
                                                                                                                                            } else {
                                                                                                                                                ?>
                                                    <input id="pcode" type="text" class="form-control" value="<?php echo ($addressResultData["postal_code"]); ?>" />
                                                <?php
                                                                                                                                            }
                                                ?>
                                            </div>





                                            <div class="col-12 mb-3">
                                                <label class="form-label mb-0">Gender</label>
                                                <input type="text" class="form-control" value="<?php echo ($userResultData["gender_name"]); ?>" readonly />
                                            </div>

                                            <div class="col-12 d-grid mt-2">
                                                <button onclick="updateProfile();" class="btn btn-primary">Update My Profile</button>
                                            </div>



                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-3 text-center">
                                    <div class="row">
                                        <span class="fw-bold text-black-50 mt-5">Display ads</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

            <?php
            } else {
                ?>
                <div class="row mt-5 mb-5 pt-1 pb-1">
                    <p class="text-center fw-bold text-primary-emphasis fs-4 mt-5 mb-5 pt-5 pb-5">Please Sign In to View your Account</p>
                </div>
                <?php
            }

            ?>


            <?php include "footer.php"; ?>
         
        </div>
    </div>

    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/script.js"></script>
</body>

</html>