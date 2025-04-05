<?php 
    class Skill {
        private $conn;
        private $table_name = 'skills';
        public $skill_id, $skill_name, $skill_category, $skill_level, $skill_description, $skill_image_path;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function createSkill() {
            $query = "INSERT INTO " . $this->table_name . " (skill_name, skill_category, skill_level, skill_description,
                      skill_image path) VALUES (:skill_name, :skill_category, :skill_level, :skill_description, :skill_image_path)";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":skill_name", $this->skill_name);
            $stmt->bindParam(":skill_category", $this->skill_category);
            $stmt->bindParam(":skill_level", $this->skill_level);
            $stmt->bindParam(":skill_description", $this->skill_description);
            $stmt->bindParam(":skill_image_path", $this->skill_image_path);

            if($stmt->execute()) {
                return ["success" => true, "message" => "Skill registered successfully."]; 
            } else {
                return ["success" => false, "message" => "Skill registration failed. Please try again." ];
            }
        }
    }
?>