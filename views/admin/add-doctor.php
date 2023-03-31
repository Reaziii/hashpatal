<?php
include ROOT . "/utils/admin.php";
$msg = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $msg = AddDoctor($_POST["name"], $_POST["email"], $_POST["password"], $_FILES["profilePicture"], $_POST["specialization"], $_POST["education"], $_POST["phone"], $_POST["gender"]);
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
        <div class="title">Add Doctor</div>
        <form action method="post" class="add-box" enctype="multipart/form-data">
            <p class="level">Name</p>
            <input name="name">
            <p class="level">Email</p>
            <input name="email">
            <p class="level">Phone</p>
            <input name="phone">
            <p class="level">Password</p>
            <input name="password">
            <p class="level">Profile Picture</p>
            <input type="file" class="form-control form-control-sm" id="formFileSm" name="profilePicture">
            <p class="level">Specialization</p>
            <select name="specialization">
                <?php
                $specializations = getAllSpecialities();
                foreach ($specializations as $item) :
                ?>
                    <option value="<?php echo $item["id"] ?>"><?php echo $item["name"] ?></option>
                <?php endforeach ?>
            </select>
            <p class="level">Gender</p>
            <select name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <p class="level">Education</p>
            <input name="education">
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