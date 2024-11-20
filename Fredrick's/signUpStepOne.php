<?php
session_start();
$email = $_POST["email"];
$pw = $_POST["pw"];

$pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

if (trim(empty($email)) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Please enter a valid email address");
} else if (trim(empty($pw))) {
    echo ("Please enter a valid password");
} else if (strlen($pw) < 8) {
    echo("Your Password is too short!");
} else if (!preg_match($pattern, $pw)) {
    echo("Password must contain at least one uppercase character, one lowercase character, one digit and one special character");
} else {
    $_SESSION["email"] = $email;
    $_SESSION["pw"] = password_hash($pw, PASSWORD_DEFAULT);
    echo("Success");    
}

?>
