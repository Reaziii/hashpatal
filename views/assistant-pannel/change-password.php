<?php
include ROOT . "/utils/assistant.php";
$msg = array("success" => "");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["newpassword"] == $_POST["confirmpassword"]) {
        $msg = AssistantchangePassword($_POST["oldpassword"], $_POST["newpassword"]);
    } else {
        $msg = array('error' => "New password and confirm password dosen't match");
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
    <?php include ROOT . "/includes.php"; ?>
</head>

<body>
    <?php include ROOT . "/views/assistant-pannel/nav.php" ?>
    <div class="dashboard">
        <div class="title">Change Password</div>
        <form action method="post" class="add-box" enctype="multipart/form-data">
            <p class="level">Old Password</p>
            <input type="password" name="oldpassword">
            <p class="level">New Password</p>
            <input type="password" name="newpassword">
            <p class="level">Confirm Password</p>
            <input type="password" name="confirmpassword">
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
            <button class="button-1">Save</button>
        </form>
    </div>
</body>

</html>