<?php

    header('Access-Control-Allow-Origin: *');
    header('Context-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/medicine.php';

    $database = new Database();
    $db = $database->Connect();

    $medicine = new Medicines($db);

    $data = json_decode(file_get_contents("php://input"));

    $medicine->med_id = $data->id;
    $medicine->med_name = $data->name;
    $medicine->med_brand = $data->brand;
    $medicine->miligram = $data->mg;
    $medicine->exp_date = $data->date;
    $medicine->stock = $data->stock;

    if($medicine->updateMedicine()){
        echo json_encode(array('messege' => 'Update successfully'));
    }else{
        echo json_encode(array('messege' => 'Update unusccessfull'));
    }
?>