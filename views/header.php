<nav class="header">
    <div class="left-side">
        <div class="logo">
            <img src="/assets/logo.png" alt="">
        </div>
        <h1>Hashpatal</h1>
        <ul class="menu-items">
            <li><a href="/">Home</a></li>
            <li><a href="/">Our Doctors</a></li>
            <li><a href="/">About Us</a></li>
            <li><a href="/">Contuct Us</a></li>
        </ul>
    </div>

    <?php
    if (!isset($_SESSION["userid"])) :
    ?>
        <a href="/login">
            <button class="button-1">
                Login
            </button>
        </a>

    <?php else : ?>
        <div class="dropdown">
            <div class="dropdown-toggle ab-xx" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="profile-pic">
                    <img src="<?php echo $_SESSION["profilePicture"] ?>" alt="">
                </div>

                <?php echo $_SESSION["name"] ?>
            </div>
            <ul class="dropdown-menu abc-yy">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a href="/logout" class="dropdown-item" href="#">Logout</a></li>
            </ul>
        </div>

    <?php endif ?>
</nav>