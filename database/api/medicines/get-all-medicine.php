<?php

    header('Access-Control-Allow-Origin: *');
    header('Context-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/medicine.php';

    $database = new Database();
    $db = $database->Connect();

    $medicine = new Medicines($db);

    $result = $medicine->getAllMedicine();

    if($result->rowCount() > 0) {
        $medicine_arr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
    
            $medicine_item = array(
                'medID' => $med_id,
                'medName' => $med_name,
                'medBrand' => $med_brand,
                'medMiligram' => $miligram,
                'medExpdate' => $exp_date,
                'medStock' => $stock
            );
            array_push($medicine_arr, $medicine_item);
        }
        echo json_encode($medicine_arr);
    }else{
        echo json_encode(array('messege' => 'Not available'));
    }
?>