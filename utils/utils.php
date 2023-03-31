<?php

function checkLogin()
{
    if (isset($_SESSION["userid"])) {
        if (isset($_SESSION["admin"])) {
            header("Location: /admin");
            die();
        }
        if (isset($_SESSION["doctor"])) {
            header("Location: /doctor-pannel");
            die();
        }
        if (isset($_SESSION["assistant"])) {
            header("Location: /assistant-pannel");
            die();
        }
    }
}

function mysqli_regular_array($result)
{
    $ret = array();
    while ($res = mysqli_fetch_array($result)) {
        array_push($ret, $res);
    }
    return $ret;
}


function returnMessage($type, $msg)
{
    return array($type => $msg);
}


