<?php
$type = "user";
include ROOT . '/utils/admin.php';
checkLogin();
$err = "";
if (isset($_GET["type"])) {
    if ($_GET["type"] == "admin") {
        $type = "admin";
    } else if ($_GET["type"] == "assistant") {
        $type = "assistant";
    } else if ($_GET["type"] == "doctor") {
        $type = "doctor";
    }

}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        if ($type == "admin") {
            if (!adminLogin()) {
                $err = "Incorrect Information!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include ROOT . "/includes.php" ?>
</head>

<body>
    <?php include ROOT . "/views/header.php" ?>
    <form method="POST" action class="login-box">
        <h1>Welcome Back!</h1>
        <p class="error"><?php echo $err; ?></p>
        <p class="level">Email: </p>
        <input placeholder="Your Email Address" name="email" type="text">
        <p class="level">Password: </p>
        <input placeholder="Your Password" name="password" type="password">
        <button class="button-1">Login</button>
    </form>
</body>

</html>