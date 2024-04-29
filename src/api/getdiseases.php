<?php
require_once("../models/database.php");

$request_method = $_SERVER["REQUEST_METHOD"];

$database = new Database();

$idSearch = isset($_GET["id"]) ? $_GET["id"] : "";

if (empty($idSearch)){
    $query = 'SELECT * FROM patho';
    $result = $database->executeQuery($query, []);
    $result = $result->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result, JSON_PRETTY_PRINT);
} else {
    $sql = 'SELECT * FROM patho where idp=:id';
    $params = [':id' => $_GET['id']];
    $result = $database->executeQuery($sql, $params);
    $result = $result->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result, JSON_PRETTY_PRINT);
}
?>
