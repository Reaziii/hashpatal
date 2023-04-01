<?php

function getAllDoctors()
{
    $query = mysqli_query(conn, "SELECT * FROM doctors");

    $ret =  mysqli_regular_array($query);
    for ($i = 0; $i < count($ret); $i++) {
        $id = $ret[$i]["specialization"];
        $speciality = mysqli_fetch_array(mysqli_query(conn, "SELECT * FROM specialities WHERE id=$id"));
        $ret[$i]["specialization"] = $speciality["name"];
    }
    return $ret;
}

function getDoctorData($id)
{
    $query = mysqli_query(conn, "SELECT * FROM doctors WHERE id=$id");
    if (mysqli_num_rows($query) == 0) {
        return "error";
    }
    return mysqli_fetch_array($query);
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
        header("Location: /doctor-pannel");
        die();
    } else {
        return false;
    }
}


function getTodaysAppointments($docid)
{
    try {
        $ret = mysqli_query(conn, "SELECT * FROM appointments WHERE docid=$docid and date=CURDATE() and checked=0 ORDER BY time ASC");
        return mysqli_regular_array($ret);
    } catch (Exception $err) {
        return "error";
    }
}


function updateAppointmentChecked($id,  $docid)
{
    try {
        mysqli_query(conn, "UPDATE appointments SET checked=1 WHERE id=$id and docid=$docid");
        return returnMessage("success", "Updated");
    } catch (Exception $err) {
        return returnMessage("error", "Something went wrong");
    }
}

function DoctorchangePassword($oldpassword, $newpassword)
{
    $password = md5($oldpassword);
    $email = $_SESSION["email"];
    if (mysqli_num_rows(mysqli_query(conn, "SELECT * FROM doctors WHERE email='$email' and  password='$password'"))) {
        $password = md5($newpassword);
        try {
            mysqli_query(conn, "UPDATE doctors SET password='$password' WHERE email='$email'");

            return array('success' => "Password Changed");
        } catch (Exception $err) {
            return array("error" => "Something went wrong");
        }
    } else {
        return array("error" => "Incorrect Old password");
    }
}