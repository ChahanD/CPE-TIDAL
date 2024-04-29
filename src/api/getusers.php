<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include __DIR__ . '/../models/database.php';


try {
    // Initialize the database connection
    $database = new Database();

    // Get the request method
    $request_method = $_SERVER["REQUEST_METHOD"];

    // Initialize the parameters array
    $idSearch = isset($_GET["id"]) ? $_GET["id"] : "";

    // Build the query and execute
    if (empty($idSearch)){
        $query = 'SELECT * FROM users';
        $result = $database->executeQuery($query, []);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result, JSON_PRETTY_PRINT);
    } else {
        $sql = 'SELECT * FROM users where id=:id';
        $params = [':id' => $_GET['id']];
        $result = $database->executeQuery($sql, $params);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
