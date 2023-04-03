<?php
$type = "user";
include ROOT . '/utils/user.php';
checkLogin();
$err = "";
$code = "";
$email = "";
if (!isset($_GET["email"]) || !isset($_GET["code"])) {
    echo "Email or code is missing";
    die();
} else {
    $code = $_GET["code"];
    $email = $_GET["email"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["newpassword"] != $_POST["confirmpassword"]) {
        $err = "Confirm password doesn't matched";
    } else {
        $err = ResetPassword($email, $code, $_POST["newpassword"]);
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
            <p class="level">New Password: </p>
            <input placeholder="New Password" name="newpassword" type="password">
            <p class="level">Confirm Password: </p>
            <input placeholder="Confirm Password" name="confirmpassword" type="password">
            <button class="button-1">Send Reset Code</button>
            <a href="/login">
                <p style="margin-top : 20px">Login</p>
            </a>
        </form>
    </div>
    <?php include ROOT . "/views/footer.php" ?>

</body>

</html>