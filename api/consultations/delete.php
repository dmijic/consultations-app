<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-Width');

include_once '../../config/Database.php';
include_once '../../models/Consultation.php';

// DB

$database = new Database();
$db = $database->connect();

// Post obj
$consultation = new Consultation($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to delete
$consultation->id = $data->id;

// Update consultation
if($consultation->delete()) {
    echo json_encode(
        array('message' => 'Post Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Deleted')
    );
}