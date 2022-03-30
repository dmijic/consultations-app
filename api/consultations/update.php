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

// Set ID to update
$consultation->id = $data->id;

$consultation->city = $data->city;
$consultation->institution = $data->institution;
$consultation->date = $data->date;
$consultation->timespan = $data->timespan;
$consultation->address = $data->address;
$consultation->phone = $data->phone;
$consultation->country_id = $data->country_id;

// Update post
if($consultation->update()) {
    echo json_encode(
        array('message' => 'Post Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Updated')
    );
}