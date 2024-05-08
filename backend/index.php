<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
require_once './databaseconnection.php';

$params = explode('/', $_SERVER['QUERY_STRING']);

switch ($params[0]) {
    case "levesek":
        switch ($_SERVER["REQUEST_METHOD"]) {
            case 'GET':
                $request = $conn->query("SELECT * FROM levesek");
                $levesek = $request->fetch_all(MYSQLI_ASSOC);
                http_response_code(200); // Változtattam itt is 201-ről 200-ra, mert a GET esetén inkább 200 a megfelelő válaszkód
                echo json_encode($levesek);
                break;

            default:
                http_response_code(405); // Hiba a metódus nem megengedett
                break;
        }
        break;
    case "fogyasztas":
        switch ($_SERVER["REQUEST_METHOD"]) {
            case "POST":
                // Használjunk paraméterezett lekérdezéseket a biztonságos adatkezelés érdekében
                $sql = "INSERT INTO `fogyasztas`(`levesekkod`, `datum`, `adag`) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iss", $_POST['levesekkod'], $_POST['datum'], $_POST['adag']);
                if ($stmt->execute()) {
                    http_response_code(201);
                } else {
                    http_response_code(500); // Változtattam itt is 401-ről 500-ra, mert belső hiba esetén inkább 500 a megfelelő válaszkód
                }
                break;

            default:
                http_response_code(405); // Hiba a metódus nem megengedett
                break;
        }
        break;
    default:
        http_response_code(404); // Az erőforrás nem található
        break;
}
?>
