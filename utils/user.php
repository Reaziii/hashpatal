<?php

function Registration($name, $email, $password, $phone, $gender, $address, $dob)
{
    try {
        if (mysqli_num_rows(mysqli_query(conn, "SELECT * FROM users WHERE email='$email' or phone='$phone'"))) {
            return returnMessage("error", "Email or Phone already exists");
        }
        $password = md5($password);
        $sql = "INSERT INTO users(name, email, password, phone, gender, address, dob) VALUES('$name','$email','$password','$phone','$gender','$address','$dob')";
        mysqli_query(conn, $sql);
        sendMail($email, "Registration Successful - Hashpatal", "Hi $name, Thank you for registration");
        header("Location: /login");
        die();
        return returnMessage("success", "Registration Successfull");
    } catch (Exception $err) {
        return returnMessage("error", "Something went wrong");
    }
}

function userLogin()
{
    $email = POST["email"];
    echo $email;
    $password = POST["password"];
    $password = md5($password);
    echo $password;
    $query = mysqli_query(conn, "SELECT * FROM users WHERE email='$email' and password='$password'");
    $count = mysqli_num_rows($query);
    $user = mysqli_fetch_array($query);
    if ($count > 0) {
        $_SESSION["name"] = $user["name"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["profilePicture"] = $user["profilePicture"];
        $_SESSION["userid"] = $user["id"];
        $_SESSION["user"] = true;
        header("Location: /user");
        die();
    } else {
        return false;
    }
}

function getUserData($id)
{
    $query = mysqli_query(conn, "SELECT * FROM users WHERE id=$id");
    if (mysqli_num_rows($query) == 0) {
        return "error";
    }
    return mysqli_fetch_array($query);
}

function bookAppointment($docid, $date, $title, $userid, $email, $name)
{
    $sql = "INSERT INTO appointments(docid, title, userid) VALUES($docid,'$title',$userid)";
    if ($date != null) {
        $sql = "INSERT INTO appointments(docid, title, userid, date) VALUES($docid,'$title',$userid,'$date')";
    }
    if (strlen($title) < 10 || strlen($title) > 50) {
        return returnMessage("error", "Title leangth is invalid!");
    }
    try {
        mysqli_query(conn, $sql);
        sendMail($email, "Appointment - Hashpatal", "Hi $name, <br/>We have received your request. We will reach you soon");
        return returnMessage("success", "Request Submitted! We will reach you as soos as possible");
    } catch (Exception $err) {
        return returnMessage("error", "Something went wrong");
    }
}


function UserchangePassword($oldpassword, $newpassword)
{
    $password = md5($oldpassword);
    $email = $_SESSION["email"];
    if (mysqli_num_rows(mysqli_query(conn, "SELECT * FROM users WHERE email='$email' and  password='$password'"))) {
        $password = md5($newpassword);
        try {
            mysqli_query(conn, "UPDATE users SET password='$password' WHERE email='$email'");

            return array('success' => "Password Changed");
        } catch (Exception $err) {
            return array("error" => "Something went wrong");
        }
    } else {
        return array("error" => "Incorrect Old password");
    }
}


function myAppointments($id)
{
    try {
        $appointments = mysqli_query(conn, "SELECT * FROM appointments WHERE userid=$id");
        return mysqli_regular_array($appointments);
    } catch (Exception $err) {
        return "Error";
    }
}
