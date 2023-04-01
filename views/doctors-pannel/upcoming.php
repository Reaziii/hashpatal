<?php
include ROOT . "/utils/doctors.php";
include ROOT . "/utils/user.php";
$doctor = getDoctorData($_SESSION["userid"]);
$msg = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $msg = updateAppointmentChecked($_POST["apid"], $doctor["id"]);
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
    <?php include ROOT . "/views/doctors-pannel/nav.php" ?>
    <div class="dashboard">
        <div class="title">Todays Appointments</div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Title</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $appointments = getTodaysAppointments($_SESSION["userid"]);
                $i = 0;
                foreach ($appointments as $appointment) :
                    $user = getUserData($appointment["userid"]);
                ?>
                    <form id="form-<?php echo $i++ ?>" action method="POST">

                        <tr>
                            <input name="apid" value="<?php echo $appointment["id"] ?>" hidden>
                            <td><a href="/user/<?php echo $user["id"] ?>"><?php echo $user["name"] ?></a></td>
                            <td><?php echo $appointment["title"] ?></td>
                            <td><input name="date" type="date" value="<?php if (isset($appointment["date"])) echo $appointment["date"];
                                                                        else echo date('Y-m-d') ?>" class="table-input"></td>
                            <td><input name="time" type="time" value="<?php echo $appointment["time"] ?>" class="table-input"></td>
                            <td>
                                <button class="button-1">Completed</button>
                            </td>
                        </tr>
                    </form>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>