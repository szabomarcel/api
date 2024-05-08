<?php 
$conmection = new mysqli("localhost", "root", "", "etelek");
if($conmection->connect_error){
    die("Connection error: " . $conmection->connect_error);
}
$conmection->set_charset("utf8");