<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page pathologies">
    <meta name="author" content="BALLEUR, ESMILAIRE, DONIKIAN, DI-MEO">
    <title>Page pathologies</title>

    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="../ressources/images/logo.webp" type="image/webp">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Ajoutez cette classe CSS pour réduire la largeur du sélecteur de méridiens */
        .select-meridien {
            width: 200px; /* Ajustez la valeur selon vos besoins */
        }
    </style>   
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

        <!-- Filter and Search Form -->
        <div class="row my-4">
            <div class="col-12">
                <form action="pathologie.php" method="get">
                    <div class="input-group mb-3">
                        <div id= "search-input-patho" class="position-relative">
                            <input type="text" class="form-control" id="searchInputPathologie" placeholder="Rechercher une pathologie" name="recherche_pathologie" aria-label="Rechercher une pathologie" autocomplete="off">
                            <div id="suggestionsBoxPathologie" class="dropdown-menu" style="display: none;"></div>
                        </div>
                        <?php include 'database.php';?>
                        <select name="symptome" class="form-select select-symptome">
                            <option value="">Choisir un Symptôme</option>
                            <?php
                            try {
                                $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                                $symptomeQuery = $pdo->query('SELECT ids, "desc" FROM symptome');
                                while ($symptome = $symptomeQuery->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value=\"" . htmlspecialchars($symptome['ids']) . "\">" . htmlspecialchars($symptome['desc']) . "</option>";
                                }
                            } catch (PDOException $e) {
                                echo "Erreur : " . $e->getMessage();
                            }
                            ?>
                        </select>

                        <!-- Dropdown for meridian -->
                        <select name="meridien" class="form-select">
                            <option value="">Choisir Méridiens</option>
                            <?php
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
                        <button class="btn btn-outline-secondary" type="submit">Recherche</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Affichage du Filtre Actif et Bouton de Réinitialisation -->
        <div class="row mb-3">
            <div class="col-10">
                <?php
                $meridien_nom = '';
                if (isset($_GET['meridien'])) {
                    $meridien_code = htmlspecialchars($_GET['meridien']);
                    try {
                        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                        $meridienQuery = $pdo->prepare("SELECT nom FROM meridien WHERE code = :code");
                        $meridienQuery->bindParam(':code', $meridien_code);
                        $meridienQuery->execute();
                        $meridien = $meridienQuery->fetch(PDO::FETCH_ASSOC);
                        if ($meridien) {
                            $meridien_nom = htmlspecialchars($meridien['nom']);
                        }
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                    }
                }
                ?>
                <p>Filtre actif : <?php echo isset($meridien_nom) ? $meridien_nom : "Aucun"; ?></p>
            </div>
            <div class="col-2">
                <a href="pathologie.php" class="btn btn-warning">Effacer les filtres</a>
            </div>
        </div>

        <?php
        require_once 'database.php';

        try {
            $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM patho WHERE 1=1";
            $params = [];

            if (isset($_GET['recherche_pathologie']) && !empty($_GET['recherche_pathologie'])) {
                $sql .= " AND \"desc\" ILIKE ?";
                $params[] = "%" . $_GET['recherche_pathologie'] . "%";
            }

            if (isset($_GET['symptome']) && !empty($_GET['symptome'])) {
                $sql .= " AND idp IN (SELECT idp FROM symptpatho WHERE ids = ?)";
                $params[] = $_GET['symptome'];
            }

            if (isset($_GET['meridien']) && !empty($_GET['meridien'])) {
                $sql .= " AND mer = ?";
                $params[] = $_GET['meridien'];
            }

            $stmt_patho_desc = $conn->prepare($sql);
            $stmt_patho_desc->execute($params);

            echo "<table border='1' class='table table-striped'>";
            echo "<tr><th>Liste des pathologies</th></tr>";

            while ($row_patho_desc = $stmt_patho_desc->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row_patho_desc['desc'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "</tr>";
            }
            echo "</table>";

        } catch (PDOException $e) {
            echo "Échec de la connexion à la base de données : " . $e->getMessage();
        }
        ?>
    </div>
    <script src="autocompletationlistpathologie.js"></script>
</body>
</html>
