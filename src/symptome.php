<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page symptome">
    <meta name="author" content="BALLEUR, ESMILAIRE, DONIKIAN, DI-MEO">
    <title>Page symptome</title>

    <link rel="icon" href="../ressources/images/logo.webp" type="image/webp">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <header>
        <div class="text-center my-4">
            <a href="index.php" class="btn btn-primary">Retour à l'accueil</a>
            <a href="pathologie.php" class="btn btn-primary">Retour aux pathologies</a>
        </div>
    </header>

    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <h1>Recherche de symptomes</h1>
            </div>
        </div>
        
        <!-- Filter and Search Form -->
        <div class="row my-4">
            <div class="col-12">
                <form action="symptome.php" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="searchInput" placeholder="Rechercher un symptome" name="recherche_symptome" aria-label="Rechercher un symptome">
                        <div id="suggestionsBox"></div>
                        <!-- Dropdown for meridian -->
                        <select name="meridien" class="form-select">
                            <option value="">Select Meridian</option>
                            <?php
                            include 'database.php';
                            try {
                                $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                                $meridienQuery = $pdo->query("SELECT code, nom FROM meridien");
                                while ($meridien = $meridienQuery->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value=\"" . htmlspecialchars($meridien['code']) . "\">" . htmlspecialchars($meridien['nom']) . "</option>";
                                }
                            } catch (PDOException $e) {
                                echo "Erreur : " . $e->getMessage();
                            }
                            ?>
                        </select>
                        <button class="btn btn-outline-secondary" type="submit">Filter</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Formulaire de Filtrage -->
        <div class="row my-4">
            <div class="col-12">
                <!-- Formulaire... -->
            </div>
        </div>

        <!-- Affichage du Filtre Actif et Bouton de Réinitialisation -->
        <div class="row mb-3">
            <div class="col-10">
                <p>Filtre actif : <?php echo isset($_GET['meridien']) ? htmlspecialchars($_GET['meridien']) : "Aucun"; ?></p>
            </div>
            <div class="col-2">
                <a href="symptome.php" class="btn btn-warning">Effacer les filtres</a>
            </div>
        </div>



<?php
        require_once 'database.php';

        try {
            $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM symptome WHERE 1=1";
            $params = [];

            if (isset($_GET['recherche_symptome']) && !empty($_GET['recherche_symptome'])) {
                $sql .= " AND \"desc\" ILIKE ?";
                $params[] = "%" . $_GET['recherche_symptome'] . "%";
            }
        
            if (isset($_GET['meridien']) && !empty($_GET['meridien'])) {
                $stmt = $pdo->prepare("SELECT s.ids, s.desc FROM symptome s JOIN symptpatho sp ON s.ids = sp.ids JOIN patho p ON sp.idp = p.idp WHERE p.mer = ?");
                $stmt->execute([$_GET['meridien']]);
                echo "<table class='table'>";
                echo "<thead><tr><th>ID Symptôme</th><th>Description</th></tr></thead>";
                echo "<tbody>";
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr><td>" . htmlspecialchars($row['ids']) . "</td><td>" . htmlspecialchars($row['desc']) . "</td></tr>";
                }
                echo "</tbody></table>";
            }

            $stmt_symptome = $conn->prepare($sql);
            $stmt_symptome->execute($params);

            echo "<table border='1' class='table table-striped'>";
            echo "<tr><th>Liste des symptomes</th></tr>";

            while ($row_symptome = $stmt_symptome->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row_symptome['desc'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "</tr>";
            }
            echo "</table>";

        } catch (PDOException $e) {
            echo "Échec de la connexion à la base de données : " . $e->getMessage();
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
