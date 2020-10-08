<?php

    header('Access-Control-Allow-Origin: *');
    header('Context-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/diagnose.php';

    $database = new Database();
    $db = $database->Connect();

    $diagnose = new Diagnose($db);

    $data = isset($_GET['id']) ? $_GET['id'] : die();

    $diagnose->patient_id = $data
    ;
    $result = $diagnose->getDiagnose();

    if($result->rowCount() > 0) {
        $diagnose_arr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
    
            $diagnose_item = array(
                'diagnose_id' => $diagnose_id,
                'patient_id' => $patient_id,
                'date' => $date,
                'diagnose' => $diagnose
            );

            array_push($diagnose_arr, $diagnose_item);
        }
        echo json_encode($diagnose_arr);
    }else{
        echo json_encode(array('messege' => 'Not available'));
    }
?>