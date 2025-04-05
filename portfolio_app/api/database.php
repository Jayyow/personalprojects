<?php 
    class Database{
        private $host = "localhost";
        private $db_name = "portfolio_app";
        private $user = "root";
        private $password = "";
        private $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                                    $this->user, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $exception) {
                http_response_code(500);
                echo json_encode(["message" => "Database connection error.", "error" => $exception->getMessage()]);
                exit();
            }
            return $this->conn;
        }
    }
?>