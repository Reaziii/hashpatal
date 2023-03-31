<?php

function getAllDoctors()
{
    $query = mysqli_query(conn, "SELECT * FROM doctors");
    return mysqli_regular_array($query);
}
