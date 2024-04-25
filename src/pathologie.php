<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';
include 'database.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/views');
$twig = new \Twig\Environment($loader);

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

    // Fetch symptomes
    $symptomes = null;
    $symptomeQuery = $conn->query('SELECT ids, "desc" FROM symptome');
    $symptomes = $symptomeQuery->fetchAll(PDO::FETCH_ASSOC);

    // Fetch meridiens
    $meridiens = null;
    $meridienQuery = $conn->query("SELECT code, nom FROM meridien");
    $meridiens = $meridienQuery->fetchAll(PDO::FETCH_ASSOC);

    // Fetch meridien nom
    $meridien_nom = '';
    if (isset($_GET['meridien']) && !empty($_GET['meridien'])) {
        $meridien_code = $_GET['meridien'];
        $meridienQuery = $conn->prepare("SELECT nom FROM meridien WHERE code = :code");
        $meridienQuery->execute([':code' => $meridien_code]);
        $meridien_nom = $meridienQuery->fetch(PDO::FETCH_ASSOC);
        $meridien_nom = $meridien_nom["nom"];
    }

    // Fetch symptome nom
    $symptome_nom = '';
    if (isset($_GET['symptome']) && !empty($_GET['symptome'])) {
        $symptome_code = $_GET['symptome'];
        $symptomeQuery = $conn->prepare('SELECT "desc" FROM symptome WHERE ids = :code');
        $symptomeQuery->execute([':code' => $symptome_code]);
        $symptome_nom = $symptomeQuery->fetch(PDO::FETCH_ASSOC);
        if ($symptome_nom && isset($symptome_nom['desc'])) {
            $symptome_nom = $symptome_nom['desc'];
        }
    }

    // Fetch pathologies
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM patho WHERE 1=1";
    $params = [];

    if (isset($_GET['recherche_pathologie']) && !empty($_GET['recherche_pathologie'])) {
        $sql .= " AND \"desc\" ILIKE ?";
        $params[] = "%" . $_GET['recherche_pathologie'] . "%";
    }

    if (isset($_GET['symptome']) && !empty($_GET['symptome'])) {
        $sql .= " AND idp IN (SELECT idp FROM symptpatho WHERE ids = ?)";
        $params[] = (int) $_GET['symptome'];
    }

    if (isset($_GET['meridien']) && !empty($_GET['meridien'])) {
        $sql .= " AND mer = ?";
        $params[] = $_GET['meridien'];
    }

    $stmt_pathologie = $conn->prepare($sql);
    $stmt_pathologie->execute($params);

    $pathologies = $stmt_pathologie->fetchAll(PDO::FETCH_ASSOC);

    // Render template
    echo $twig->render('pathologie.html.twig', [
        'symptomes' => $symptomes,
        'meridiens' => $meridiens,
        'meridien_nom' => $meridien_nom,
        'symptome_nom' => $symptome_nom,
        'pathologies' => $pathologies
    ]);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
