<?php

    header('Access-Control-Allow-Origin: *');
    header('Context-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/prescription.php';

    $database = new Database();
    $db = $database->Connect();

    $prescrip = new Prescription($db);

    $prescrip->diagnose_id = isset($_GET['id']) ? $_GET['id'] : die();

    $result = $prescrip->getPrescription();

    if($result->rowCount() > 0) {
        $prescrip_arr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
    
            $prescrip_item = array(
                'med_name' => $med_name,
                'med_brand' => $med_brand,
                'miligram' => $miligram,
                'quantity' => $quantity,
            );
            array_push($prescrip_arr, $prescrip_item);
        }
        echo json_encode($prescrip_arr);
    }else{
        echo json_encode(array('messege' => 'Not available'));
    }
?>