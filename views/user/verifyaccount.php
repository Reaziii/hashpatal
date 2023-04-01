<?php
include ROOT . '/utils/user.php';
$email = "";
$code = "";
$msg = "";

if (isset($_GET["email"])) {
    $email = $_GET["email"];
}
if (isset($_GET["code"])) {
    $code = $_GET["code"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $code = $_POST["code"];
    $msg = verifyAccount($email, $code);
    if(isset($msg["success"])){
        header("Location: /login");
        die();
    }
}

$random_hash = md5(uniqid(rand(), true));
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
    <div class="login-div">
        <form method="POST" action class="login-box">
            <div class="message">
                <?php
                if (isset($msg["success"])) {
                    $text = $msg["success"];
                    echo "<p class='success-msg'>$text</p>";
                }
                if (isset($msg["error"])) {
                    $text = $msg["error"];
                    echo "<p class='error-msg'>$text</p>";
                }
                ?>
            </div>
            <h1>Verify You Email!</h1>
            <p class="error"><?php
                                ?></p>
            <p class="level">Email: </p>
            <input value="<?php echo $email ?>" placeholder="Your Email Address" name="email" type="text">
            <p class="level">Verification code: </p>
            <input value="<?php echo $code ?>" placeholder="Verification code" name="code" type="text">
            <button class="button-1">Verify</button>
            <!-- <a href="/registration">
                <p style="margin-top : 20px">Resend</p>
            </a> -->
        </form>
    </div>
    <?php include ROOT . "/views/footer.php" ?>

</body>

</html>