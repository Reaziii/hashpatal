<?php
include ROOT . "/utils/assistant.php";
include ROOT . "/utils/user.php";

$assistant = getAssistantData($_SESSION["userid"]);
$msg = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $msg = updateAppointmentStatus($_POST["apid"], $_POST["status"], $_POST["date"], $_POST["time"]);
}
var_dump($msg);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assistant pannel | upcoming</title>
    <?php include ROOT . "/includes.php"; ?>
</head>

<body>
    <?php include ROOT . "/views/assistant-pannel/nav.php" ?>
    <div class="dashboard">
        <div class="title">Upcoming Appointments</div>
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
                $appointments = getAllUpcomingAppointments($assistant["docid"]);
                $i = 0;
                foreach ($appointments as $appointment) :
                    $user = getUserData($appointment["userid"]);
                ?>
                    <form id="form-<?php echo $i++ ?>" action method="POST">

                        <tr>
                            <input name="apid" value="<?php echo $appointment["id"] ?>" hidden>
                            <input name="status" hidden value="<?php echo $appointment["status"] ?>">
                            <td><a href="/user/<?php echo $user["id"] ?>"><?php echo $user["name"] ?></a></td>
                            <td><?php echo $appointment["title"] ?></td>
                            <td><input name="date" type="date" value="<?php if (isset($appointment["date"])) echo $appointment["date"];
                                                                        else echo date('Y-m-d') ?>" class="table-input"></td>
                            <td><input name="time" type="time" value="<?php echo $appointment["time"] ?>" class="table-input"></td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php echo $appointment["status"] ?>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item pending">Pending</a></li>
                                        <li><a class="dropdown-item accept">Accepted</a></li>
                                        <li><a class="dropdown-item cancel">Canceled</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </form>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
<script>
    $(".pending").map((i, item) => {
        item.addEventListener("click", () => {
            let form = "#form-" + i;
            form = $(form)[0];
            console.log(i);

            form.elements["status"].value = "pending";
            form.submit();
        })
    })
    $(".accept").map((i, item) => {
        item.addEventListener("click", () => {
            let form = "#form-" + i;
            form = $(form)[0];
            form.elements["status"].value = "accepted";
            form.submit();
        })
    })
    $(".cancel").map((i, item) => {
        item.addEventListener("click", () => {
            let form = "#form-" + i;
            form = $(form)[0];
            form.elements["status"].value = "canceled";
            form.submit();
        })
    })
</script>

</html>