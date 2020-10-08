<?php

    header('Access-Control-Allow-Origin: *');
    header('Context-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/patient.php';

    $database = new Database();
    $db = $database->Connect();

    $patient = new Patient($db);

    $result = $patient->getAllPatient();

    if($result->rowCount() > 0) {
        $patient_arr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
    
            $patient_item = array(
                'patient_id' => $patient_id,
                'fullname' => $fullname,
                'address' => $address,
                'gender' => $gender,
                'birthdate' => $birthdate,
                'contact_number' => $contact_number,
            );
            array_push($patient_arr, $patient_item);
        }
        echo json_encode($patient_arr);
    }else{
        echo json_encode(array('messege' => 'Not available'));
    }
?>