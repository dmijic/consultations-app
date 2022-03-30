<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Consultation.php';

// DB

$database = new Database();
$db = $database->connect();

// Post obj
$consultation = new Consultation($db);

//Get ID
$consultation->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get post
$consultation->read_single();

// Create array
$consultation_arr = array(
    'id' => $consultation->id,
    'city' => $consultation->city,
    'institution' => $consultation->institution,
    'date' => $consultation->date,
    'timespan' => $consultation->timespan,
    'address' => $consultation->address,
    'phone' => $consultation->phone,
    'country_id' => $consultation->country_id,
    'country_name' => $consultation->country_name
);

// Make JSON

print_r(json_encode($consultation_arr));

?>