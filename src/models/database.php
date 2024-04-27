<?php
function getDbConnection() {
    $host = 'postgres';
    $dbname = 'acudb';
    $user = 'postgres';
    $password = 'postgres';

    try {
        $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Échec de la connexion à la base de données : " . $e->getMessage();
        return null;
    }
}
?>
