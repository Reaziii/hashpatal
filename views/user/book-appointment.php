<?php
authCheck("user");
$type = "user";
include ROOT . '/utils/user.php';
include ROOT . '/utils/doctors.php';
$user = getUserData($_SESSION["userid"]);
$doctor = getDoctorData($id);
$msg = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = null;
    if ($_POST["date"]) {
        $date = $_POST["date"];
    }
    $msg = bookAppointment($doctor["id"], $date, $_POST["title"], $user["id"], $user["email"], $user["name"]);
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
    <form method="POST" action class="registration-box">
        <div class="input-div">
            <p class="level">Name</p>
            <input disabled value="<?php echo $user["name"] ?>" type="text" name="name">
        </div>
        <div class="input-div">
            <p class="level">Email</p>
            <input disabled value="<?php echo $user["email"] ?>" type="text" name="email">
        </div>
        <div class="input-div">
            <p class="level">Phone</p>
            <input disabled value="<?php echo $user["phone"] ?>" type="text" name="phone">
        </div>
        <div class="input-div">
            <p class="level">Doctor Name</p>
            <input disabled value="<?php echo $doctor["name"] ?>" type="text" name="address">
        </div>
        <div class="input-div">
            <p class="level">Title</p>
            <input type="text" name="title">
        </div>
        <div class="input-div">
            <p class="level">Date</p>
            <input type="date" name="date">
        </div>
        <button class="button-1">Request For appointment</button>
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
</body>

</html>