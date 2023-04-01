<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/router.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/utils/utils.php';
require_once __DIR__ . '/utils/upload.php';
require_once __DIR__ . '/utils/mail.php';
any("/", "views/home/index.php");
any("/login", "views/login.php");
any("/logout", "logout.php");
any("/admin", "views/admin/index.php");
any("/admin/add-admin", "views/admin/add-admin.php");
any("/admin/change-password", "views/admin/change-password.php");
any("/admin/specialities", "views/admin/specialities.php");
any("/admin/add-doctor", "views/admin/add-doctor.php");
any("/admin/add-assistant", "views/admin/add-assistant.php");
any("/registration", "views/user/registration.php");
any("/user", "views/user/index.php");
any("/doctors", "views/doctors.php");
any('/book-appointment/$id', "views/user/book-appointment.php");

any("/assistant-pannel", 'views/assistant-pannel/index.php');
any("/assistant-pannel/upcoming-appointments", 'views/assistant-pannel/upcoming.php');
any("/assistant-pannel/change-password", 'views/assistant-pannel/change-password.php');


any("/doctor-pannel","views/doctors-pannel/index.php");
any("/doctor-pannel/upcoming-appointments", 'views/doctors-pannel/upcoming.php');
any("/doctor-pannel/change-password", 'views/doctors-pannel/change-password.php');
