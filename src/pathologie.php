<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page pathologies">
    <meta name="author" content="BALLEUR, ESMILAIRE, DONIKIAN, DI-MEO">
    <title>Page pathologies</title>

    <link rel="icon" href="../ressources/images/logo.webp" type="image/webp">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <header>
        <div class="text-center my-4">
            <a href="index.php" class="btn btn-primary">Retour à l'accueil</a>
            <a href="symptome.php" class="btn btn-primary">Retour aux symptômes</a>

        </div>
    </header>

    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <h1>Recherche de pathologies</h1>
            </div>
        </div>

        <!-- Ici commence le formulaire de recherche -->
        <div class="row my-4">
            <div class="col-12">
                <form action="pathologie.php" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Rechercher une pathologie" name="recherche_patho_desc" aria-label="Rechercher une pathologie" aria-describedby="button-addon-patho">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon-patho">Rechercher</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Fin du formulaire de recherche -->

        <!-- Ici, nous inclurons les résultats de recherche de PHP -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<?php
require_once 'database.php';

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['recherche_patho_desc']) && !empty($_GET['recherche_patho_desc'])) {
        $stmt_patho_desc = $conn->prepare("SELECT * FROM patho WHERE \"desc\" ILIKE :desc");
        $stmt_patho_desc->execute(['desc' => '%' . $_GET['recherche_patho_desc'] . '%']);
    } else {
        $stmt_patho_desc = $conn->query("SELECT * FROM patho");
    }

    // Afficher les résultats des pathologies ici
    echo "<table border='1' class='table table-striped'>";
    echo "<tr><th>Méridien</th><th>Type</th><th>Description</th></tr>";

    while ($row_patho_desc = $stmt_patho_desc->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row_patho_desc['mer'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row_patho_desc['type'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row_patho_desc['desc'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "</tr>";
    }
    echo "</table>";

} catch (PDOException $e) {
    echo "Échec de la connexion à la base de données : " . $e->getMessage();
}
?>

