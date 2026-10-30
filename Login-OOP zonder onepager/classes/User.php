<?php
    // Functie: classdefinitie User
    // Auteur: Studentnaam

    require_once __DIR__ . '/../Database.php';

    class User extends Database {

        // Eigenschappen
        public string $username = "";
        public string $email = "";
        private string $password = "";

        function setPassword($password){
            $this->password = $password;
        }
        function getPassword(){
            return $this->password;
        }

        public function showUser() {
            echo "<br>Username: " . htmlspecialchars($this->username) . "<br>";
            echo "<br>Email: " . htmlspecialchars($this->email) . "<br>";
        }

        public function registerUser() : array {
            $status = false;
            $errors = $this->validateUser();

            if($this->username != "" && count($errors) == 0){

                // Check user exist in database
                $conn = $this->dbConnect();

                $sql = "SELECT id FROM user WHERE username = :username OR email = :email";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':username' => $this->username,
                    ':email' => $this->email
                ]);

                if($stmt->fetch()){
                    array_push($errors, "Username of email bestaat al.");
                } else {
                    // username opslaan in tabel login
                    // INSERT INTO `user` (`username`, `password`, `role`) VALUES ('kjhasdasdkjhsak', 'asdasdasdasdas', '');
                    // Manier 1

                    $sql = "INSERT INTO user (username, password, email, role)
                            VALUES (:username, :password, :email, :role)";

                    $stmt = $conn->prepare($sql);
                    $status = $stmt->execute([
                        ':username' => $this->username,
                        ':password' => password_hash($this->password, PASSWORD_DEFAULT),
                        ':email' => $this->email,
                        ':role' => 'user'
                    ]);

                    if(!$status){
                        array_push($errors, "Registreren mislukt.");
                    }
                }
            }
            return $errors;
        }

        function validateUser(){
            $errors=[];

            if (empty($this->username)){
                array_push($errors, "Invalid username");
            } else if (empty($this->password)){
                array_push($errors, "Invalid password");
            }

            // Test username > 3 tekens
            if (strlen($this->username) < 3 || strlen($this->username) > 50){
                array_push($errors, "Username moet tussen 3 en 50 tekens zijn.");
            }

            return $errors;
        }

        public function loginUser(): bool {

            // Connect database
            $conn = $this->dbConnect();

            // Zoek user in de table user met username = $this->username
            // Doe SELECT * from user WHERE username = $this->username
            $sql = "SELECT * FROM user WHERE username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':username' => $this->username]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Indien gevonden EN password klopt dan sessie vullen
            if($user && password_verify($this->password, $user['password'])){
                if(session_status() === PHP_SESSION_NONE){
                    session_start();
                }

                session_regenerate_id(true);

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Return true indien gelukt anders false
                return true;
            }

            return false;
        }

        // Check if the user is already logged in
        public function isLoggedin(): bool {
            // Check if user session has been set
            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }

            if(isset($_SESSION['user_id'])){
                $this->username = $_SESSION['username'];
                return true;
            }

            return false;
        }

        public function getUser(string $username): bool {
            // Connect database
            $conn = $this->dbConnect();

            // Doe SELECT * from user WHERE username = $username
            $sql = "SELECT * FROM user WHERE username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':username' => $username]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user){
                //Indien gevonden eigenschappen vullen met waarden uit de SELECT
                $this->username = $user['username'];
                $this->email = $user['email'];
                return true;
            } else {
                return false;
            }
        }

        public function logout(){
            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }

            // remove all session variables
            $_SESSION = [];

            // destroy the session
            session_destroy();
        }
    }
?>