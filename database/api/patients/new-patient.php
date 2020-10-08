<?php

    header('Access-Control-Allow-Origin: *');
    header('Context-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/patient.php';

    $database = new Database();
    $db = $database->Connect();

    $patient = new Patient($db);

    $data = json_decode(file_get_contents("php://input"));

    $patient->fullname = $data->fullname;
    $patient->address = $data->address;
    $patient->birthdate = $data->birthdate;
    $patient->gender = $data->gender;
    $patient->number = $data->number;

    if($patient->newPatient()) {
        echo json_encode(array('messege' => 'New Patient created'));
    }else{
        echo json_encode(array('messege' => 'Patient not created'));
    }