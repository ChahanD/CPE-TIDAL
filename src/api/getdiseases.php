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
    $idSearch = isset($_GET["id"]) ? $_GET["id"] : null;
    $merSearch = isset($_GET["mer"]) ? $_GET["mer"] : null;
    $typeSearch = isset($_GET["type"]) ? $_GET["type"] : null;
    $descSearch = isset($_GET["desc"]) ? $_GET["desc"] : null;

    // Initialize the parameters array
    $params = [];

    // Build the query
    $query = 'SELECT * FROM patho WHERE 1 = 1';

    // Add the search parameters to the query
    if ($idSearch !== null) {
        $query .= ' AND idp = :id';
        $params[':id'] = $idSearch;
    }

    if ($merSearch !== null) {
        $query .= ' AND mer = :mer';
        $params[':mer'] = $merSearch;
    }

    if ($typeSearch !== null) {
        $query .= ' AND type = :type';
        $params[':type'] = $typeSearch;
    }

    if ($descSearch !== null) {
        $query .= ' AND "desc" = :desc';
        $params[':desc'] = $descSearch;
    }

    // Execute the query
    $result = $database->executeQuery($query, $params);

    // Fetch the results from the query result object
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);

    // Encode the results as JSON and output
    echo json_encode($rows, JSON_PRETTY_PRINT);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
