<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Hashpatal</title>
    <?php include ROOT . '/includes.php' ?>
</head>
<body>
    <?php include ROOT . '/views/header.php' ?>
    <section class="landing-page">
        <div class="landing-text">
            <h1>Your health,<br />top priority always.</h1>
            <p>Health is not just the absence of disease, it's a state of complete physical, mental, and social well-being.</p>
        </div>
        <img class="hero-pic" src="/assets/landingdoc.svg" alt="">
        <a href="/doctors">Meet Our Specialist</a>
    </section>
    <?php include ROOT . "/views/home/services.php" ?>
    <?php include ROOT . "/views/home/why-us.php" ?>
    <?php include ROOT . "/views/home/message-us.php" ?>
    <?php include ROOT . "/views/home/pageend.php" ?>
    <?php include ROOT . "/views/footer.php" ?>
</body>

</html>