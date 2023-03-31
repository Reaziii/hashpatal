<?php
function adminCheck()
{
    if (!IS_ADMIN) {
        header("Location: /");
        die();
    }
}

function adminLogin()
{
    $email = POST["email"];
    echo $email;
    $password = POST["password"];
    $password = md5($password);
    $query = mysqli_query(conn, "SELECT * FROM admins WHERE email='$email' and password='$password'");
    $count = mysqli_num_rows($query);
    $user = mysqli_fetch_array($query);
    if ($count > 0) {
        $_SESSION["name"] = $user["name"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["profilePicture"] = $user["profilePicture"];
        $_SESSION["userid"] = $user["id"];
        $_SESSION["admin"] = true;
        header("Location: /admin");
        die();
    } else {
        return false;
    }
}
