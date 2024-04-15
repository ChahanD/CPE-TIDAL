<?php
require_once 'database.php';

$searchTerm = $_GET['search'];
$pathologies = [];

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare('SELECT "desc" FROM patho WHERE "desc" ILIKE :searchTerm LIMIT 10');
    $stmt->execute(['searchTerm' => '%' . $searchTerm . '%']);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $pathologies[] = htmlspecialchars($row['desc'], ENT_QUOTES, 'UTF-8');
    }
} catch (PDOException $e) {
    echo "Échec de la connexion à la base de données : " . $e->getMessage();
}

if (!empty($pathologies)) { // Utilisez $pathologies au lieu de $suggestions
    foreach ($pathologies as $pathology) { // Utilisez $pathologies au lieu de $suggestions
        echo '<div class="suggestion-item">' . $pathology . '</div>';
    }
} else {
    echo '<div class="suggestion-item">Aucun résultat trouvé.</div>';
}
