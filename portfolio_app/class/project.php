<?php 
    class Project {
        private $conn;
        private $table_name = "projects";
        public $project_id, $project_title, $project_description, $project_image_path;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function createProject() {
            $query = "INSERT INTO " . $this->table_name . " (project_title, project_description, project_image_path) 
                      VALUES (:project_title, :project_description, :project_image_path)";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":project_title", $this->project_title);
            $stmt->bindParam(":project_description", $this->project_description);
            $stmt->bindParam(":project_image_path", $this->project_image_path);

            if($stmt->execute()) {
                return ["success" => true, "message" => "Project registered successfully."];
            } else {
                return ["success" => false, "message" => "Project registration failed. Please try again"];
            }
        }
    }
?>