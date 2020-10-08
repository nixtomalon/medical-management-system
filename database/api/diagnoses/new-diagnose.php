<?php

    header('Access-Control-Allow-Origin: *');
    header('Context-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/diagnose.php';
    include_once '../../models/prescription.php';
    include_once '../../models/medicine.php';

    $database = new Database();
    $db = $database->Connect();

    $diagnose = new Diagnose($db);
    $prescrip = new Prescription($db);
    $medicine = new Medicines($db);

    $data = json_decode(file_get_contents("php://input"));

    $diagnose->patient_id = $data->patientid;
    $diagnose->date = $data->date;
    $diagnose->diagnose = $data->diagnose;

    if($diagnose->newDiagnose()) { // new diagnose

        $diagnose_result = $diagnose->getCurrentDiagId(); // get id of newly diagnosed patient

        if($diagnose_result->rowCount() > 0){

            $row = $diagnose_result->fetch(PDO::FETCH_ASSOC);
            $prescrip->diagnose_id = $row['diagnose_id'];
            $prescrip->pres_item = $data->medicine;

            if($prescrip->newPrescription()){ // insert prescription details

                $medicine->med_item = $data->medicine;
                if($medicine->subtractMedStock()) { // deduct medicine stock
                    echo json_encode(array('messege' => 'New diagnose created'));
                }
            }
        }        
    }else{
        echo json_encode(array('messege' => 'diagnose not created'));
    }