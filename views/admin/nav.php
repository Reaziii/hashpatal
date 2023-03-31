<nav class="dash-nav">
    <div class="logo">
        <img src="/assets/logo.png" alt="">
        <h1>Hashpatal</h1>
    </div>
    <div class="menu-itemss">
        <a href="/admin"><button><?php echo $__windows ?> Dashboard</button></a>
        <a href="/admin/add-admin"><button>
                <?php echo $__add_admin ?>Add Admin</button></a>
        <a href="/admin/add-doctor"><button>
                <?php echo $__add_doctor ?> Add Doctor</button></a>
        <a href="/admin/specialities"><button>
                <?php echo $__speciality ?>Speciality</button></a>
        <a href="/admin/add-assistant"><button><?php echo $__add_assistant ?>Add Assistant</button></a>
        <a href="/admin/change-password"><button>
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