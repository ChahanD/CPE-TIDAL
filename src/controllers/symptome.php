<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';
include '../models/database.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views');
$twig = new \Twig\Environment($loader);

try {
    $conn = getDbConnection();

    // Fetch meridiens
    $meridiens = null;
    $meridienQuery = $conn->query("SELECT code, nom FROM meridien");
    $meridiens = $meridienQuery->fetchAll(PDO::FETCH_ASSOC);

    // Fetch meridien nom
    $meridien_nom = '';
    if (isset($_GET['meridien']) && !empty($_GET['meridien'])) {
        $meridienCode = $_GET['meridien'];
        $meridienQuery = $conn->prepare("SELECT nom FROM meridien WHERE code = :code");
        $meridienQuery->execute([':code' => $meridienCode]);
        $meridien_nom = $meridienQuery->fetch(PDO::FETCH_ASSOC);
        $meridien_nom = $meridien_nom["nom"];
    }

    // Fetch symptomes
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT DISTINCT s.* FROM symptome s
            LEFT JOIN symptpatho sp ON s.ids = sp.ids
            LEFT JOIN patho p ON sp.idp = p.idp
            WHERE 1=1";
    $params = [];

    if (isset($_GET['recherche_symptome']) && !empty($_GET['recherche_symptome'])) {
        $sql .= " AND s.desc ILIKE ?";
        $params[] = "%" . $_GET['recherche_symptome'] . "%";
    }

    if (isset($_GET['meridien']) && !empty($_GET['meridien'])) {
        $sql .= " AND p.mer = ?";
        $params[] = $_GET['meridien'];
    }

    $stmt_symptome = $conn->prepare($sql);
    $stmt_symptome->execute($params);

    $symptomes = $stmt_symptome->fetchAll(PDO::FETCH_ASSOC);

    // Render template
    echo $twig->render('./symptome.html.twig', [
        'meridiens' => $meridiens,
        'symptomes' => $symptomes,
        'meridien_nom' => $meridien_nom
    ]);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
