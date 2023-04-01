<?php
$type = "user";
include ROOT . '/utils/user.php';
checkLogin();
$msg = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["confirmpassword"] != $_POST["password"]) {
        $msg = returnMessage("error", "Confirm password doesn't match");
    } else $msg = Registration($_POST["name"], $_POST["email"], $_POST["password"], $_POST["phone"], $_POST["gender"], $_POST["address"], $_POST["dob"]);
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
    <!-- <?php include ROOT . "/views/header.php" ?> -->
    <form method="POST" action class="registration-box">
        <div class="input-div">
            <p class="level">Name</p>
            <input type="text" name="name">
        </div>
        <div class="input-div">
            <p class="level">Email</p>
            <input type="text" name="email">
        </div>
        <div class="input-div">
            <p class="level">Phone</p>
            <input type="text" name="phone">
        </div>
        <div class="input-div">
            <p class="level">Address</p>
            <input type="text" name="address">
        </div>
        <div class="input-div">
            <p class="level">Gender</p>
            <select name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="input-div">
            <p class="level">Date Of Birth</p>
            <input type="date" type="text" name="dob">
        </div>
        <div class="input-div">
            <p class="level">Password</p>
            <input type="password" type="text" name="password">
        </div>
        <div class="input-div">
            <p class="level">Confirm Password</p>
            <input type="password" type="text" name="confirmpassword">
        </div>
        <button class="button-1">Register</button>
    </form>
    <div style="margin-left: 100px;" class="message">
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
    <?php include ROOT . "/views/footer.php" ?>
</body>

</html>