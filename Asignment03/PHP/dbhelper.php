<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "asm3";
$port = 3307;
global $conn;


function execute($sql){
    global $mysql_hostname,$mysql_user, $mysql_password, $mysql_database,$port;
    $con = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database, $port);
    mysqli_query($con, $sql);
    mysqli_close($con);
}

function executeResult($sql){
    global $mysql_hostname,$mysql_user, $mysql_password, $mysql_database, $port;
    $con = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database, $port);
    //select
    $result = mysqli_query($con, $sql);
    $data = [];
    if($result != null){
        while($row = mysqli_fetch_array($result,1)){
            $data[] = $row;
        }
    }
    //close connection
    mysqli_close($con);
    return $data;
}

function executeSingleResult($sql){
    global $mysql_hostname,$mysql_user, $mysql_password, $mysql_database;
    $con = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);
    //search
    $result = mysqli_query($con, $sql);
    $row = null;
    if($result != null){
        $row = mysqli_fetch_array($result,1);       
    }
    //close connection
    mysqli_close($con);
    return $row;
}