<?php
$type = "user";
include ROOT . '/utils/user.php';
checkLogin();
$err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"])) {
        $err = sendResetCode($_POST["email"]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include ROOT . "/includes.php" ?>
</head>

<body>
    <?php include ROOT . "/views/header.php" ?>
    <div class="login-div">
        <form method="POST" action class="login-box">
            <h1>Reset Your Password!</h1>
            <p class="error"><?php echo $err; ?></p>
            <p class="level">Email: </p>
            <input placeholder="Your Email Address" name="email" type="text">
            <button class="button-1">Send Reset Code</button>
            <a href="/login">
                <p style="margin-top : 20px">Login</p>
            </a>
        </form>
    </div>
    <?php include ROOT . "/views/footer.php" ?>

</body>

</html>