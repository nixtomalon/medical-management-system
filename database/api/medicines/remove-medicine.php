<?php

    header('Access-Control-Allow-Origin: *');
    header('Context-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/medicine.php';

    $database = new Database();
    $db = $database->Connect();

    $medicine = new Medicines($db);

    $data = json_decode(file_get_contents("php://input"));
    $medicine->med_id = $data->remove;

    if($medicine->removeMedicine()){
        echo json_encode(array('messege' => 'Successfully remove'));
    }else{
        echo json_encode(array('messege' => 'Failed to remove'));
    }
?>