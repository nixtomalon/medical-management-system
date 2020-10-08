<?php

    header('Access-Control-Allow-Origin: *');
    header('Context-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/medicine.php';

    $database = new Database();
    $db = $database->Connect();

    $medicine = new Medicines($db);

    $data = json_decode(file_get_contents("php://input"));

    $medicine->med_name = $data->mname;
    $medicine->med_brand = $data->mbrand;
    $medicine->miligram = $data->mmg;
    $medicine->exp_date = $data->mdate;
    $medicine->stock = $data->mstock;

    if($medicine->newMedicine()) {
        echo json_encode(array('messege' => 'New Medicine created'));
    }else{
        echo json_encode(array('messege' => 'Medicine not created'));
    }