<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../models/database.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views');
$twig = new \Twig\Environment($loader);


try {
    // Get the parameters
    $params = [
        'recherche_pathologie' => $_GET['recherche_pathologie'] ?? null,
        'symptome' => $_GET['symptome'] ?? null,
        'meridien' => $_GET['meridien'] ?? null,
        'search' => $_GET['search'] ?? null
    ];

    // Get the database connection
    $db = new Database();

    // Fetch symptomes
    $symptomes = $db->getSymptomes();

    // Fetch meridiens
    $meridiens = $db->getMeridiens();

    // Fetch meridien nom
    $meridien_nom = '';
    if (isset($params['meridien']) && !empty($params['meridien'])) {
        $meridien_nom = $db->getMeridienNom($params['meridien']);
    }

    // Fetch symptome nom
    $symptome_nom = '';
    if (isset($params['symptome']) && !empty($params['symptome'])) {
        $symptome_nom = $db->getSymptomeNom($params['symptome']);
    }

    // Fetch pathologies
    $pathologies = $db->getListPathologies($params);

    // Fetch autocompletation list
    $autocompletation_list = [];
    if (isset($params['search']) && !empty($params['search'])) {
        $autocompletation_list = $db->getListAutocompletation($params['search'], "patho");
        header('Content-Type: application/json');
        echo json_encode($autocompletation_list);
        exit;
    }

    // Check if user is connected
    if (!isset($_COOKIE['user_id'])) {
        $is_user_connected = false;
    } else {
        $is_user_connected = true;
    }

    // Render template
    echo $twig->render('./pathologie.html.twig', [
        'symptomes' => $symptomes,
        'meridiens' => $meridiens,
        'meridien_nom' => $meridien_nom,
        'symptome_nom' => $symptome_nom,
        'pathologies' => $pathologies,
        'userconnected' => $is_user_connected
    ]);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
