<?php
authCheck("user");
$type = "user";
include ROOT . '/utils/user.php';
include ROOT . '/utils/doctors.php';

$msg = array();
$user = getUserData($_SESSION["userid"]);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["oldpassword"]) && isset($_POST["newpassword"]) && isset($_POST["confirmpassword"])) {
        if ($_POST["newpassword"] != $_POST["confirmpassword"]) {
            $msg = returnMessage("error", "Confirm password doesn't match");
        } else {
            $msg = UserchangePassword($_POST["oldpassword"], $_POST["newpassword"]);
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
    <div class="registration-box">
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
            <p class="level">Address</p>
            <input disabled value="<?php echo $user["address"] ?>" type="text" name="address">
        </div>
        <div class="input-div">
            <p class="level">Gender</p>
            <select disabled value="<?php echo $user["gender"] ?>" name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="input-div">
            <p class="level">Date Of Birth</p>
            <input disabled value="<?php echo $user["dob"] ?>" type="date" type="text" name="dob">
        </div>
    </div>

    <div class="title2 margin-left-100">Change Password</div>

    <form action method="POST" class="change-pass">
        <div class="input-div">
            <p class="level">Oldpassword</p>
            <input type="password" name="oldpassword">
        </div>
        <div class="input-div">
            <p class="level">New Password</p>
            <input type="password" name="newpassword">
        </div>
        <div class="input-div">
            <p class="level">Confirm Password</p>
            <input type="password" name="confirmpassword">
        </div>
        <button class="button-1">Save</button>
        <div style="margin-top : 10px" class="message">
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
    </form>

    <div class="my-appointments">
        <div class="title">My Appointments</div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Doctor Name</th>
                    <th scope="col">Title</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $appointments = myAppointments($user["id"]);
                foreach ($appointments as $appointment) :
                    $doctor = getDoctorData($appointment["docid"]);
                ?>
                    <tr>
                        <td><?php echo $doctor["name"] ?></td>
                        <td><?php echo $appointment["title"] ?></td>
                        <td><?php echo $appointment["date"] ?></td>
                        <td><?php echo $appointment["time"] ?></td>
                        <td><?php echo $appointment["status"] ?></td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include ROOT . "/views/footer.php" ?>
</body>

</html>