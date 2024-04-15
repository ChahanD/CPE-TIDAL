<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page symptome">
    <meta name="author" content="BALLEUR, ESMILAIRE, DONIKIAN, DI-MEO">
    <title>Page symptome</title>
    <link rel="stylesheet" href="style.css">

    <link rel="icon" href="../ressources/images/logo.webp" type="image/webp">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/symptome.css">
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
                        <div class="position-relative">
                            <input type="text" class="form-control" id="searchInput" placeholder="Rechercher un symptome" name="recherche_symptome" aria-label="Rechercher un symptome" autocomplete="off">
                            <div id="suggestionsBox" class="dropdown-menu" style="display: none;"></div>
                        </div>

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
                        <button class="btn btn-outline-secondary" type="submit">Recherche</button>
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
                <a href="symptome.php" class="btn btn-warning">Effacer les filtres</a>
            </div>
        </div>



        <?php
        require_once 'database.php';

        try {
            $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT s.* FROM symptome s
                    LEFT JOIN symptpatho sp ON s.ids = sp.ids
                    LEFT JOIN patho p ON sp.idp = p.idp
                    WHERE 1=1";
            $params = [];

            if (isset($_GET['recherche_symptome']) && !empty($_GET['recherche_symptome'])) {
                $sql .= " AND s.desc ILIKE ?";
                $params[] = "%" . $_GET['recherche_symptome'] . "%";
            }

            if (isset($_GET['meridien']) && !empty($_GET['meridien'])) {
                $sql .= " AND p.mer = ?";
                $params[] = $_GET['meridien'];
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
    <script src="autocompletationlistsymptome.js"></script>
</body>
</html>
