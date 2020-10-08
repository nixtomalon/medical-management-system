<?php

    header('Access-Control-Allow-Origin: *');
    header('Context-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/diagnose.php';

    $database = new Database();
    $db = $database->Connect();

    $diagnose = new Diagnose($db);

    $result = $diagnose->getAllDiagnoseAndPatient();

    if($result->rowCount() > 0) {
        $diagnose_arr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
    
            $diagnose_item = array(
                'patient_id' => $patient_id,
                'diagnose_id' => $diagnose_id,
                'fullname' => $fullname,
                'contact_number' => $contact_number,
                'diagnose' => $diagnose,
                'date' => $date
            );
            array_push($diagnose_arr, $diagnose_item);
        }
        echo json_encode($diagnose_arr);
    }else{
        echo json_encode(array('messege' => 'Not available'));
    }
?>