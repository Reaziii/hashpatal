<?php
include ROOT . "/utils/admin.php";
$msg = array("success" => "");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add-speciality-name"])) {
        $msg = addSpeciality($_POST["add-speciality-name"]);
    }
    if (isset($_POST["delete-item-id"])) {
        deleteSpeciallity($_POST["delete-item-id"]);
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
    <?php include ROOT . "/views/admin/nav.php" ?>
    <div class="dashboard">
        <div class="title">Add Speciality</div>
        <form action method="post" class="add-box" enctype="multipart/form-data">
            <p class="level">Name</p>
            <input type="text" name="add-speciality-name">
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
        <table class="table speci">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col" class="action">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $items = getAllSpecialities();
                foreach ($items as $speciality) :
                ?>
                    <tr>
                        <td><?php echo $speciality["id"] ?></td>
                        <td><?php echo $speciality["name"] ?></td>
                        <td class="action">
                            <form action method="post">
                                <input name="delete-item-id" type="text" hidden value="<?php echo $speciality["id"] ?>">
                                <button type="submit" class="delete-button">
                                    <i class="fa-sharp fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>