<?php
class Database {
    private $conn;

    public function __construct() {
        /*
        * Database connection
        */
        $this->connect();
    }

    private function connect() {
        /*
        * Connection to the database
        * @throws Exception if connection failed
        */
        $host = 'postgres';
        $dbname = 'acudb';
        $user = 'postgres';
        $password = 'postgres';

        try {
            $this->conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    public function getSymptomes() {
        /*
        * Get symptomes from the database
        * @throws Exception if query failed
        * @return array of symptomes
        */
        try {
            $symptomeQuery = $this->conn->query('SELECT ids, "desc" FROM symptome');
            return $symptomeQuery->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            throw new Exception("Failed to get symptomes: " . $e->getMessage());
        }
    }

    public function getMeridiens() {
        /*
        * Get meridiens from the database
        * @throws Exception if query failed
        * @return array of meridiens
        */
        try {
            $meridienQuery = $this->conn->query("SELECT code, nom FROM meridien");
            return $meridienQuery->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            throw new Exception("Failed to get meridiens: " . $e->getMessage());
        }
    }

    public function getMeridienNom($meridienCode) {
        /*
        * Get meridien name from the database
        * @throws Exception if query failed
        * @return string meridien name
        */
        try {
            $meridienQuery = $this->conn->prepare("SELECT nom FROM meridien WHERE code = :code");
            $meridienQuery->execute([':code' => $meridienCode]);
            $meridien_nom = $meridienQuery->fetch(PDO::FETCH_ASSOC);
            return $meridien_nom ? $meridien_nom["nom"] : null;
        } catch(PDOException $e) {
            throw new Exception("Failed to get meridien name: " . $e->getMessage());
        }
    }

    public function getSymptomeNom($symptomeCode) {
        /*
        * Get symptome name from the database
        * @throws Exception if query failed
        * @return string symptome name
        */
        try {
            $symptomeQuery = $this->conn->prepare('SELECT "desc" FROM symptome WHERE ids = :code');
            $symptomeQuery->execute([':code' => $symptomeCode]);
            $symptome_nom = $symptomeQuery->fetch(PDO::FETCH_ASSOC);
            return $symptome_nom ? $symptome_nom['desc'] : null;
        } catch(PDOException $e) {
            throw new Exception("Failed to get symptome name: " . $e->getMessage());
        }
    }

    public function getListPathologies($params) {
        /*
        * Get list of pathologies from the database
        * @throws Exception if query failed
        * @return array of pathologies
        */
        try {
            $sql = "SELECT * FROM patho WHERE 1=1";
            $execute_params = [];
            if (isset($params['recherche_pathologie']) && !empty($params['recherche_pathologie'])) {
                $sql .= " AND \"desc\" ILIKE ?";
                $execute_params[] = "%" . $params['recherche_pathologie'] . "%";
            }
            if (isset($params['symptome']) && !empty($params['symptome'])) {
                $sql .= " AND idp IN (SELECT idp FROM symptpatho WHERE ids = ?)";
                $execute_params[] = (int) $params['symptome'];
            }
            if (isset($params['meridien']) && !empty($params['meridien'])) {
                $sql .= " AND mer = ?";
                $execute_params[] = $params['meridien'];
            }
            $stmt_pathologie = $this->conn->prepare($sql);
            $stmt_pathologie->execute($execute_params);
            return $stmt_pathologie->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            throw new Exception("Failed to get list of pathologies: " . $e->getMessage());
        }
    }

    public function getListSymptomes($params) {
        /*
        * Get list of symptomes from the database
        * @throws Exception if query failed
        * @return array of symptomes
        */
        try {
            $sql = "SELECT DISTINCT s.* FROM symptome s
                    LEFT JOIN symptpatho sp ON s.ids = sp.ids
                    LEFT JOIN patho p ON sp.idp = p.idp
                    WHERE 1=1";
            $execute_params = [];
            if (isset($params['recherche_symptome']) && !empty($params['recherche_symptome'])) {
                $sql .= " AND s.desc ILIKE ?";
                $execute_params[] = "%" . $params['recherche_symptome'] . "%";
            }
            if (isset($params['meridien']) && !empty($params['meridien'])) {
                $sql .= " AND p.mer = ?";
                $execute_params[] = $params['meridien'];
            }
            $stmt_symptome = $this->conn->prepare($sql);
            $stmt_symptome->execute($execute_params);
            return $stmt_symptome->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            throw new Exception("Failed to get list of symptomes: " . $e->getMessage());
        }
    }

    public function getListAutocompletation($searchTerm, $tableName) {
        /*
        * Get autocompletion list from the database
        * @throws Exception if query failed
        * @return array of autocompletion list
        */
        try {
            if ($tableName ==='symptome') {
                $stmt = $this->conn->prepare('SELECT "desc" FROM symptome WHERE "desc" ILIKE :searchTerm LIMIT 10');
            } else if ($tableName === 'patho') {
                $stmt = $this->conn->prepare('SELECT "desc" FROM patho WHERE "desc" ILIKE :searchTerm LIMIT 10');
            } else return [];
            $stmt->execute(['searchTerm' => '%' . $searchTerm . '%']);
            $autocompletation_list = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $autocompletation_list[] = htmlspecialchars($row['desc'], ENT_QUOTES, 'UTF-8');
            }
            return $autocompletation_list;
        } catch(PDOException $e) {
            throw new Exception("Failed to get autocompletion list: " . $e->getMessage());
        }
    }

    public function login($username, $password) {
        /*
        * Login user
        * @throws Exception if query failed
        * @return array user data
        */
        try {
            $query = $this->conn->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
            $query->execute([':username' => $username]);
            $user = $query->fetch(PDO::FETCH_ASSOC);
            if (!$user) {
                return false;
            }
            if (!password_verify($password, $user['password'])) {
                return false;
            }
            return $user;
        } catch(PDOException $e) {
            throw new Exception("Failed to login: " . $e->getMessage());
        }
    }

    public function register($username, $password) {
        /*
        * Register user
        * @throws Exception if query failed
        * @return boolean
        */
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = $this->conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $query->execute([':username' => $username, ':password' => $hashedPassword]);
            return true;
        } catch(PDOException $e) {
            throw new Exception("Failed to register: " . $e->getMessage());
        }
    }

    public function getUserById($id) {
        /*
        * Get user by its id
        * @throws Exception if query failed
        * @return array user data
        */
        $query = $this->conn->prepare('SELECT * FROM users WHERE id = :id');
        $query->execute([':id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>
