<?php
require_once __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/twig_components');
$twig = new \Twig\Environment($loader);

echo $twig->render('index.html.twig', ['currentPage' => 'index']);
?>