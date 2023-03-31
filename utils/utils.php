<?php

function checkLogin()
{
    if (isset($_SESSION["userid"])) {
        if (isset($_SESSION["admin"])) {
            header("Location: /admin");
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
