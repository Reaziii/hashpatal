<?php
if (!isset($_SESSION["assistant"])) {
    header("Location: /");
    die();
}
?>
<nav class="dash-nav">
    <div class="logo">
        <img src="/assets/logo.png" alt="">
        <h1>Hashpatal</h1>
    </div>
    <div class="menu-itemss">
        <a href="/assistant-pannel"><button><?php echo $__windows ?> Dashboard</button></a>
        <a href="/assistant-pannel/upcoming-appointments"><button>
                <?php echo $__pending_appointment ?>Upcoming</button></a>
        <a href="/assistant-pannel/change-password"><button>
                <?php echo $__change_password; ?>Change password</button></a>
    </div>
    <div class="profile">
        <img src="<?php echo $_SESSION["profilePicture"] ?>" alt="">
        <div class="text">
            <p class="name"><?php echo $_SESSION["name"] ?></p>
            <p class="email"><?php echo $_SESSION["email"] ?></p>
        </div>
        <a href="/logout">
            <?php echo $__logout; ?>
        </a>
    </div>
</nav>