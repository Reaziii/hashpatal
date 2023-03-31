<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/router.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/utils/utils.php';
require_once __DIR__ . '/utils/upload.php';
require_once __DIR__ . '/utils/mail.php';
any("/", "views/index.php");
any("/login", "views/login.php");
any("/logout", "logout.php");
any("/admin", "views/admin/index.php");
any("/admin/add-admin", "views/admin/add-admin.php");
any("/admin/change-password", "views/admin/change-password.php");
any("/admin/specialities", "views/admin/specialities.php");
any("/admin/add-doctor", "views/admin/add-doctor.php");
any("/admin/add-assistant", "views/admin/add-assistant.php");
