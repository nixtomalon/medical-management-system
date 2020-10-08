<?php

    header('Access-Control-Allow-Origin: *');
    header('Context-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/patient.php';

    $database = new Database();
    $db = $database->Connect();

    $patient = new Patient($db);

    $data = json_decode(file_get_contents("php://input"));

    $patient->patient_id = $data->id;
    $patient->fullname = $data->fullname;
    $patient->address = $data->address;
    $patient->gender = $data->gender;
    $patient->birthdate = $data->birthdate;
    $patient->number = $data->number;

    if($patient->updatePatient()){
        echo json_encode(array('messege' => 'Update successfully'));
    }else{
        echo json_encode(array('messege' => 'Update unusccessfull'));
    }
?>