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
