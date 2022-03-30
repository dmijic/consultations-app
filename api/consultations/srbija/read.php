<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../config/Database.php';
include_once '../../../models/Consultation.php';

// DB

$database = new Database();
$db = $database->connect();

// Post obj
$consultation = new Consultation($db);

// Blog post query
$result = $consultation->read();
$num = $result->rowCount();

if($num > 0) {
    $consultations_arr = array();
    $consultations_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $consultation_item = array(
            'id' => $id,
            'city' => $city,
            'institution' => $institution,
            'date' => $date,
            'timespan' => $timespan,
            'address' => $address,
            'phone' => $phone,
            'country_id' => $country_id,
            'country_name' => $country_name
        );

        // Push to "data" if country is Srbija
        if($consultation_item['country_id'] === '4'){
            array_push($consultations_arr['data'], $consultation_item);
        }
    }

    // Turn to JSON
    echo json_encode($consultations_arr);

} else {
    echo json_encode(
        array('message' => 'No consultations found.')
    );

}

?>