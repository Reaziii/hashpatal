<?php
include ROOT . "/utils/doctors.php";
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
    <div class="doctors-page">
        <?php
        $doctors = getAllDoctors();
        foreach ($doctors as $doctor) :
        ?>
            <div class="doctor-div">
                <img src="<?php echo $doctor["profilePicture"] ?>" alt="">
                <div class="details">
                    <p><?php echo $doctor["name"] ?></p>
                    <p><?php echo $doctor["specialization"] ?></p>
                    <p><?php echo $doctor["education"] ?></p>
                    <a href="/book-appointment/<?php echo $doctor["id"]?>">Book Appoinment <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>


        <?php endforeach; ?>
    </div>
</body>

</html>