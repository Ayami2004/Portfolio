<?php
session_start();
require("connection.php");
$email = $_POST['email'];
$password = $_POST['pw'];
$rMe = $_POST["rm"];

$query = "SELECT * FROM `users` WHERE `email`=?";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $login_count = $user['login_count'] + 1;

        $update_query = "UPDATE `users` SET `login_count`=?, `last_login`=NOW() WHERE `email`=?";
        $update_stmt = $connection->prepare($update_query);
        $update_stmt->bind_param("is", $login_count, $email);

        if ($update_stmt->execute()) {
            $_SESSION["u"] = $user;
            echo "Success";
            if ($rMe == "true") {
                setcookie("email", $email, time()+(60*60*24*365));
                setcookie("password", $password, time()+(60*60*24*365));
            }
            $update_stmt->close();
        }
    } else {
        echo "Invalid Password";
    }
} else {
    echo "User Not Found. Please try again.";
}

$stmt->close();

$connection->close();
