<?php
include ROOT . "/utils/admin.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    addAdmin($_POST["name"], $_POST["email"], $_POST["password"], $_FILES["profilePicture"]);
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
    <?php include ROOT . "/views/admin/nav.php" ?>
    <div class="dashboard">
        <div class="title">Add Admin</div>
        <form action method="post" class="add-box" enctype="multipart/form-data">
            <p class="level">Name</p>
            <input name="name">
            <p class="level">Email</p>
            <input name="email">
            <p class="level">Password</p>
            <input name="password">
            <p class="level">Name</p>
            <input type="file" class="form-control form-control-sm" id="formFileSm" name="profilePicture">
            <button class="button-1">Save</button>
        </form>
    </div>
</body>
</html>