<nav class="header">
    <div class="left-side">
        <div class="logo">
            <img src="/assets/logo.png" alt="">
        </div>
        <h1>Hashpatal</h1>
        <ul class="menu-items">
            <li><a href="/">Home</a></li>
            <li><a href="/doctors">Our Doctors</a></li>
            <li><a href="/about-us">About Us</a></li>
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
            <button class="dropdown-toggle ab-xx" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="profile-pic">
                    <img src="<?php echo $_SESSION["profilePicture"] ?>" alt="">
                </div>

                <?php echo $_SESSION["name"] ?>
            </button>
            <ul class="dropdown-menu abc-yy">
                <?php
                if (isset($_SESSION["admin"])) :
                ?>
                    <li><a class="dropdown-item" href="/admin">Admin Pannel</a></li>
                <?php
                elseif (isset($_SESSION["doctor"])) :
                ?>
                    <li><a class="dropdown-item" href="/doctor-pannel">Doctors Pannel</a></li>
                <?php
                elseif (isset($_SESSION["assistant"])) :
                ?>
                    <li><a class="dropdown-item" href="/assistant-pannel">Assistants Pannel</a></li>

                <?php
                elseif (isset($_SESSION["user"])) :
                ?>
                    <li><a class="dropdown-item" href="/user">Users Pannel</a></li>
                <?php endif; ?>
                <li><a href="/logout" class="dropdown-item" href="#">Logout</a></li>
            </ul>
        </div>

    <?php endif ?>
</nav>