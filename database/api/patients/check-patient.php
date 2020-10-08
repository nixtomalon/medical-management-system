<?php

    header('Access-Control-Allow-Origin: *');
    header('Context-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/patient.php';

    $database = new Database();
    $db = $database->Connect();

    $patient = new Patient($db);

    $patient->patient_id = isset($_GET['id']) ? $_GET['id'] : die();

    $patient->searchPatient();

    $patient_arr = array(
        'id' => $patient->patient_id,
        'fullname' => $patient->fullname,
        'age' => $patient->birthdate,
        'address' => $patient->address,
        'gender' => $patient->gender
    );

    echo json_encode($patient_arr);
?>