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


function addAdmin($name, $email, $password, $profilePicture)
{
    $filename = upload($profilePicture);
    if ($filename == "error") {
        return array("error" => "Image upload failed");
    }
    if (mysqli_num_rows(mysqli_query(conn, "SELECT * FROM admins WHERE email='$email'"))) {
        return array("error" => "Email Already exists");
    }
    try {
        $password = md5($password);
        mysqli_query(conn, "INSERT INTO admins(email, password, name, profilePicture) VALUES('$email','$password','$name','$filename')");
        return array("success" => "Admin added");
    } catch (Exception $err) {
        echo $err;
        return array("error" => "Something went wrong");
    }
}


function AdminchangePassword($oldpassword, $newpassword)
{
    $password = md5($oldpassword);
    $email = $_SESSION["email"];
    if (mysqli_num_rows(mysqli_query(conn, "SELECT * FROM admins WHERE email='$email' and  password='$password'"))) {
        $password = md5($newpassword);
        try {
            mysqli_query(conn, "UPDATE admins SET password='$password' WHERE email='$email'");
            return array('success' => "Password Changed");
        } catch (Exception $err) {
            return array("error" => "Something went wrong");
        }
    } else {
        return array("error" => "Incorrect Old password");
    }
}


function addSpeciality($name)
{
    if (mysqli_num_rows(mysqli_query(conn, "SELECT * FROM specialities WHERE name='$name'"))) {
        return array("error" => "Already exists");
    } else {
        try {
            mysqli_query(conn, "INSERT INTO specialities(name) VALUES('$name')");
            return array("success" => "Added successfully");
        } catch (Exception $err) {
            echo $err;
            return array("error" => "Something went wrong");
        }
    }
}


function deleteSpeciallity($id)
{
    try {
        mysqli_query(conn, "DELETE FROM specialities WHERE id=$id");
        return array("success" => "Deleted successfully");
    } catch (Exception $err) {
        return array("error" => "Something went wrong");
    }
}

function getAllSpecialities()
{
    try {
        $query = mysqli_query(conn, "SELECT * FROM specialities");
        return mysqli_regular_array($query);
    } catch (Exception $err) {
        return array();
    }
}


function deleteDoctor($id)
{
    try {
        mysqli_query(conn, "DELETE FROM doctors WHERE id=$id");
        return returnMessage("success", "Deleted Successfully");
    } catch (Exception $err) {
        return returnMessage("error", "Something went wrong!");
    }
}


function AddDoctor($name, $email, $password, $image, $specialization, $education, $phone, $gender)
{
    $profilePicture = upload($image);
    if ($profilePicture == "error") {
        return returnMessage("error", "image upload failed!");
    }
    try {
        if (mysqli_num_rows(mysqli_query(conn, "SELECT * FROM doctors WHERE email='$email' || phone='$phone'"))) {
            return returnMessage("error", "Email or Phone already exists");
        }
        $password = md5($password);
        $sql = "INSERT INTO doctors(name, email, password, profilePicture, specialization, education, phone, gender) VALUES ('$name','$email','$password','$profilePicture',$specialization,'$education','$phone','$gender')";
        mysqli_query(conn, $sql);
        return returnMessage("success", "Doctor Added Successfully");
    } catch (Exception $err) {
        echo $err;
        return returnMessage("error", "Something went wrong!");
    }
}
