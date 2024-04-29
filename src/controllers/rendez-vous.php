<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../models/database.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views');
$twig = new \Twig\Environment($loader);


// Check if user is connected
if (!isset($_COOKIE['user_id'])) {
    $is_user_connected = false;
} else {
    $is_user_connected = true;
}

// Render template
echo $twig->render('./rendez-vous.html.twig', [
    'currentPage' => 'rdv',
    'userconnected' => $is_user_connected
]);
?>
