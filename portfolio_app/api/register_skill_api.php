<?php 
    session_start();

    header("Content-type: application/json");
    include_once "database.php";
    include_once "../class/skill.php";

    $database = new Database();
    $db = $database->getConnection();
    $skill = new Skill($db);

    $data = json_decode(file_get_contents("php://input", true));

    $data['skill_image_path'] = $_FILES['image']['name'];
    echo $data['skill_image_path'];

    $file_name = $data['skill_image_path'];
    echo $file_name;

    $temp_path = $_FILES['image']['temp_name'];
    $file_size = $_FILES['image']['size'];

    echo "I got here 1";
    if(empty($file_name)) {
        $error_msg = json_encode(["message" => "Please select an image.", "status" => false]);
        echo $error_msg;
    } else {
        $upload_path = 'uploads/';
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $valid_ext = array('jpeg', 'jpg', 'gif', 'png');

        if(!in_array($file_ext, $valid_ext)) {
            $error_msg = json_encode(["message" => "Sorry only JPEG, JPG, GIF & PNG  are allowed.", "status" => false]);
            echo $error_msg;
        }

        if(file_exists($upload_path . $file_name)) {
            $error_msg = json_encode(["message" => "Sorry file already exists check upload folder.", "status" => false]);
            echo $error_msg;
        }

        if(!$file_size < 5000000){
            $error_msg = json_encode(["message" => "Sorry your file is too large, please upload 5 mb size.", "status" => false]);
            echo $error_msg;
        }

        move_uploaded_file($temp_path, $upload_path . $file_name);
        echo "I got here 2";
    }

    $skill->skill_name = htmlspecialchars(strip_tags(trim($data['skill_name'])));
    $skill->skill_category = htmlspecialchars(strip_tags(trim($data['skill_category'])));
    $skill->skill_level = htmlspecialchars(strip_tags(trim($data['skill_level'])));
    $skill->skill_description = htmlspecialchars(strip_tags(trim($data['skill_description'])));
    $skill->skill_image_path = htmlspecialchars(strip_tags(trim($file_name)));

    if ($skill->createSkill()) {
        http_response_code(201);
        echo json_encode(["message" => "Skill registered successfully. Please verify your account.", "success" => true]);
    }
    else {
        http_response_code(500);
        echo json_encode(["message" => "Error registering skill.", "success" => false]);
    }
?>