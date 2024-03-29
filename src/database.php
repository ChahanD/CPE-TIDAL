<?php
// Paramètres de connexion à la base de données
$host = 'postgres';
$dbname = 'acudb';
$user = 'postgres';
$password = 'postgres';

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Échec de la connexion à la base de données : " . $e->getMessage();
}

function rechercherNom($conn, $recherche)
{
    $stmt = $conn->prepare("SELECT * FROM meridien WHERE nom ILIKE ?");
    $stmt->execute(["%$recherche%"]);
    return $stmt;
}

function rechercherPathologie($conn, $recherche)
{
    $stmt = $conn->prepare("SELECT * FROM patho WHERE desc ILIKE ?");
    $stmt->execute(["%$recherche%"]);
    return $stmt;
}

