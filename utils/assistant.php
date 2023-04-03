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
        return "Incorrect Information";
    }
}


function getAllUpcomingAppointments($docid)
{
    $ret = mysqli_query(conn, "SELECT * FROM appointments WHERE docid=$docid and (date IS NULL or date>=CURDATE())");
    return mysqli_regular_array($ret);
}


function getAssistantData($id)
{
    $ret = mysqli_query(conn, "SELECT * FROM assistants WHERE id=$id");
    return mysqli_fetch_array($ret);
}

function updateAppointmentStatus($id, $status, $date, $time)
{
    try {
        mysqli_query(conn, "UPDATE appointments SET status='$status', date='$date', time='$time' WHERE id=$id");
        return returnMessage("success", "Updated");
    } catch (Exception $err) {
        return returnMessage("error", "Something went wrong");
    }
}


function AssistantchangePassword($oldpassword, $newpassword)
{
    $password = md5($oldpassword);
    $email = $_SESSION["email"];
    if (mysqli_num_rows(mysqli_query(conn, "SELECT * FROM assistants WHERE email='$email' and  password='$password'"))) {
        $password = md5($newpassword);
        try {
            mysqli_query(conn, "UPDATE assistants SET password='$password' WHERE email='$email'");

            return array('success' => "Password Changed");
        } catch (Exception $err) {
            return array("error" => "Something went wrong");
        }
    } else {
        return array("error" => "Incorrect Old password");
    }
}
