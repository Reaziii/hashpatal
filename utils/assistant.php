<?php

function assistantLogin()
{
    $email = POST["email"];
    echo $email;
    $password = POST["password"];
    $password = md5($password);
    echo $password;
    $query = mysqli_query(conn, "SELECT * FROM assistants WHERE email='$email' and password='$password'");
    $count = mysqli_num_rows($query);
    $user = mysqli_fetch_array($query);
    if ($count > 0) {
        $_SESSION["name"] = $user["name"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["profilePicture"] = $user["profilePicture"];
        $_SESSION["userid"] = $user["id"];
        $_SESSION["assistant"] = true;
        header("Location: /assistant-pannel");
        die();
    } else {
        return false;
    }
}
