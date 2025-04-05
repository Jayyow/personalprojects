<?php 
    class Certificate {
        private $conn;
        private $table_name = "certificates";
        public $certificate_id, $certificate_name, $certificate_description, $certificate_image_path;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function createCertificate() {
            $query = "INSERT INTO " . $this->table_name . " (certificate_name, certificate_description, certificate_image_path) 
                      VALUES (:certificate_name, :certificate_description, :certificate_image_path)";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":certificate_name", $this->certificate_name);
            $stmt->bindParam(":certificate_description", $this->certificate_description);
            $stmt->bindParam(":certificate_image_path", $this->certificate_image_path);

            if($stmt->execute()) {
                return ["success" => true, "message" => "Certificate registered successfully."];
            } else {
                return ["success" => false, "message" => "Certificate registration failed. Please try again"];
            }
        }
    }
?>