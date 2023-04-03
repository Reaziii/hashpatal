<?php

function Registration($name, $email, $password, $phone, $gender, $address, $dob)
{
    try {
        if (mysqli_num_rows(mysqli_query(conn, "SELECT * FROM users WHERE (email='$email' or phone='$phone') and active=1"))) {
            return returnMessage("error", "Email or Phone already exists");
        }
        $password = md5($password);
        $sql = "INSERT INTO users(name, email, password, phone, gender, address, dob) VALUES('$name','$email','$password','$phone','$gender','$address','$dob')";
        mysqli_query(conn, $sql);
        $user = mysqli_fetch_array(mysqli_query(conn, "SELECT * FROM users WHERE email='$email' and password='$password'"));
        sendVerificationCode($user["id"]);
        header("Location: /registration/verify?email=$email");
        die();
        return returnMessage("success", "Registration Successfull");
    } catch (Exception $err) {
        return returnMessage("error", "Something went wrong");
    }
}
function sendVerificationCode($userid)
{
    $uid = uniqid();
    $code = "";
    for ($i = strlen($uid) - 1; strlen($code) != 6; $i--) {
        $code = $code . $uid[$i];
    }
    $user = mysqli_fetch_array(mysqli_query(conn, "SELECT * FROM users WHERE id=$userid"));
    $mail = $user["email"];
    $link = HOME_URL . "/registration/verify?email=$mail&code=$code";
    $name = $user["name"];
    $body = "Hi $name, <br/> Your Hashpatal user verification code is : $code<br/><a href='$link'>Click here to verify</a>";
    sendMail($mail, "Verification code - Hashpatal", $body);
    try {
        mysqli_query(conn, "INSERT INTO verifyCode(email, userid, code) VALUES('$mail','$userid','$code')");
    } catch (Exception $err) {
        // echo $err;
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
        if ($user["active"] == 0) {
            return "Account is not active! please <a href='/registration/verify'>verify</a>";
        }
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




function verifyAccount($email, $code)
{
    $query = mysqli_query(conn, "SELECT * FROM verifyCode WHERE email='$email' and code='$code'");
    if (mysqli_num_rows($query)) {
        $instance = mysqli_fetch_array($query);
        $userid = $instance["userid"];
        mysqli_query(conn, "UPDATE users SET active=1 WHERE id='$userid'");
        mysqli_query(conn, "DELETE FROM users WHERE email='$email' and active=0");
        mysqli_query(conn, "DELETE FROM verifyCode WHERE email='$email'");
        return returnMessage("success", "Verified");
    }
    return returnMessage("error", "Wrong verification code");
}


function sendResetCode($email)
{
    $uid = uniqid();
    $code = "";
    for ($i = strlen($uid) - 1; strlen($code) != 6; $i--) {
        $code = $code . $uid[$i];
    }
    $user = mysqli_query(conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($user) == 0) {
        return "Email not found";
    }
    $user = mysqli_fetch_array($user);
    $userid = $user["id"];
    $link = HOME_URL . "/resetpassword?email=$email&code=$code";
    $name = $user["name"];
    $body = "Hi $name,<br/><a href='$link'>Click here to reset your password</a>";
    sendMail($email, "Reset password code - Hashpatal", $body);
    try {
        mysqli_query(conn, "INSERT INTO resetCode(email, userid, code) VALUES('$email','$userid','$code')");
        return "Reset code has been sent!";
    } catch (Exception $err) {
        // echo $err;
        return "Email not found!";
    }
}


function ResetPassword($email, $code, $password)
{
    $query = mysqli_query(conn, "SELECT * FROM resetCode WHERE email='$email' and code='$code'");
    if (mysqli_num_rows($query) == 0) {
        return  "Wrong Verfication code";
    }
    $instance = mysqli_fetch_array($query);
    $password = md5($password);
    $userid = $instance["userid"];
    try {
        $codeid = $instance["id"];
        mysqli_query(conn, "UPDATE users SET password='$password' WHERE id=$userid");
        mysqli_query(conn, "DELETE FROM resetCode WHERE id=$codeid");
        return "Password Changed! Go to login";
    } catch (Exception $err) {
        return  "Something went wrong";
    }
}
