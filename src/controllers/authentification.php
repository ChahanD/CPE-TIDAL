<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../vendor/autoload.php';

include '../models/database.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views');
$twig = new \Twig\Environment($loader);


try {
    // Get the database connection
    $db = new Database();

    // Andle the connection
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            try {
                $user = $db->login($username, $password);

                if ($user) {
                    // Connexion réussie, stocker l'ID de l'utilisateur dans la session et créer un cookie
                    $_SESSION['user_id'] = $user['id'];
                    setcookie('user_id', $user['id'], time() + (60), '/', '', false, false); 
                    $_SESSION['message'] = ['text' => 'Connexion réussie !', 'type' => 'success'];
                    header('Location: ../index.php');
                    exit();
                } else {
                    $_SESSION['message'] = ['text' => 'Nom d\'utilisateur ou mot de passe incorrect.', 'type' => 'danger'];
                }
            } catch (Exception $e) {
                $_SESSION['message'] = ['text' => 'Erreur de connexion à la base de données : ' . $e->getMessage(), 'type' => 'danger'];
            }
        } elseif (isset($_POST['register'])) {
            $username = $_POST['new-username'];
            $password = $_POST['new-password'];
            $confirmPassword = $_POST['confirm-password'];
    
            if ($password !== $confirmPassword) {
                $_SESSION['message'] = ['text' => "Les mots de passe ne correspondent pas.", 'type' => 'danger'];
            } else {
                try {
                    $db->register($username, $password);
                    $_SESSION['message'] = ['text' => 'Compte créé avec succès ! Vous pouvez maintenant vous connecter.', 'type' => 'success'];
                } catch (Exception $e) {
                    $_SESSION['message'] = ['text' => 'Erreur d\'inscription à la base de données : ' . $e->getMessage(), 'type' => 'danger'];
                }
            }
        }
    }

    // Show message
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    } else {
        $message = null;
    }

    // Render template
    echo $twig->render('./authentification.html.twig', [
        'currentPage' => 'authentification',
        'message' => $message,
        'cookies' => $_COOKIE
    ]);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
