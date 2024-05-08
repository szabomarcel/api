<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
require_once 'databaseconnection.php';
$params = explode('/', $_SERVER['QUERY_STRING']);
/*if($params[0] === "LEVESEK"){
    require_once 'levesek/index.php';
}else{
    http_response_code(405);
    $errottJson = array('message' =>'Nincs ilyen API');
}*/
switch (strtolower($params[0])){
    case "Levesek":
        switch ($_SERVER["REQUEST_METHOD"]){
            case 'GET':
                $request = $conn->query('SELECT * FROM levesek');
                $levesek = $request->fetch_all(MYSQL_ASSOC);
                echo json_encode($levesek);
                break;
            default:
                break;
        }
        break;
    case "fogyasztas": 
        switch ($_SERVER['REQUEST_METHOD']){
            case 'POST':
                $sql = "INSERT INTO fogyasztas(datum, adag, levesekkod) VALUE (".$_POST['datum']."," .$_POST['adag']. "," .$_POST['levesekkod'].")";
                if($conn->query($sql)){
                    http_response_code(201);
                }else{}
                break;
        }
}