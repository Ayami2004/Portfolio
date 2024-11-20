<?php
session_start();

require("connection.php");

function capitalizeFirstLetter($string)
{
    // First converts the entire string to lowercase and ucfirst() then capitalizes the first letter
    return ucfirst(strtolower($string));
}

$fname = capitalizeFirstLetter($_POST["fname"]);
$lname = capitalizeFirstLetter($_POST["lname"]);
$mobile = $_POST["m"];
$email = $_SESSION["email"];
$pw = $_SESSION["pw"];
$pattern = "/07[0,1,2,4,5,6,7,8]{1}[0-9]{7}/";
if (trim(empty($fname)) || trim(empty($lname)) || trim(empty($mobile))) {
    echo ("Please fill out all the fields");
} else if (!preg_match($pattern, $mobile)) {
    echo("Please recheck your mobile number");
} else {
    if ($connection->connect_error) {
        die("Connection Failed: " . $connection->connect_error);
    } else {
        $statement = $connection->prepare("INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`, `created_at`, `status`) VALUES (?, ?, ?, ?, NOW(), '1')");

        if ($statement === false) {
            die("Preparation Failed: " . $connection->error);
        }

        $statement->bind_param("ssss", $fname, $lname, $email, $pw);

        if ($statement->execute()) {

            // Insert mobile number into the `mobiles` table
            $user_id = $connection->insert_id; // Get the last inserted ID
            $mobile_statement = $connection->prepare("INSERT INTO `contact` (`user_id`, `mobile`) VALUES (?, ?)");

            if ($mobile_statement === false) {
                die("Preparation Failed: " . $connection->error);
            }

            $mobile_statement->bind_param("is", $user_id, $mobile);

            if ($mobile_statement->execute()) {
                echo ("Success");
            } else {
                echo "Error: " . $mobile_statement->error;
            }

            $mobile_statement->close();

            // Clear and destroy session
            $_SESSION = array();
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    '',
                    time() - 42000,
                    $params["path"],
                    $params["domain"],
                    $params["secure"],
                    $params["httponly"]
                );
            }
            session_destroy();
        } else {
            echo ("Error: " . $statement->error);
        }

        $statement->close();
    }

    $connection->close();
}
