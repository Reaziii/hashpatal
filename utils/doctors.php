<?php

function getAllDoctors()
{
    $query = mysqli_query(conn, "SELECT * FROM doctors");
    return mysqli_regular_array($query);
}


function doctorLogin()
{
    $email = POST["email"];
    echo $email;
    $password = POST["password"];
    $password = md5($password);
    echo $password;
    $query = mysqli_query(conn, "SELECT * FROM doctors WHERE email='$email' and password='$password'");
    $count = mysqli_num_rows($query);
    $user = mysqli_fetch_array($query);
    if ($count > 0) {
        $_SESSION["name"] = $user["name"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["profilePicture"] = $user["profilePicture"];
        $_SESSION["userid"] = $user["id"];
        $_SESSION["doctor"] = true;
        header("Location: /doctors-pannel");
        die();
    } else {
        return false;
    }
}
