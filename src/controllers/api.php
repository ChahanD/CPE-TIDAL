<?php
    require_once("../models/database.php");
    $request_method = $_SERVER["REQUEST_METHOD"];

    $idSearch = isset($_GET["id"]) ? $_GET["id"] : "";

    if (empty($idSearch)){
        $query = 'SELECT * FROM patho';
        $result = $database->prepare_execute($query, array());
        $result = pg_fetch_all($result);
        echo json_encode($result, JSON_PRETTY_PRINT);
    }else{
        $sql = 'SELECT * FROM patho where idp=$1';
        $params = array($_GET['id']);
        $result = $database->prepare_execute($sql,$params);
        $result = pg_fetch_all($result);
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
?>