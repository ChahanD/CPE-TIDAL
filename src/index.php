<?php
$request = $_SERVER['REQUEST_URI'];

// Parse the URL and return the path
$path = parse_url($request, PHP_URL_PATH);

// Switch the path and require the right controller
switch ($path) {
    case '/patho' :
        require __DIR__ . '/controllers/pathologie.php';
        break;
    case '/rdv' :
        require __DIR__ . '/controllers/rendez-vous.php';
        break;
    case '/sympto' :
        require __DIR__ . '/controllers/symptome.php';
        break;
    case '/auth' :
        require __DIR__ . '/controllers/authentification.php';
        break;
    case '/api' :
        require __DIR__ . '/api/getdiseases.php';
        break;
    default:
        require __DIR__ . '/controllers/home.php';
        break;
}
?>
