<?php

    header('Access-Control-Allow-Origin: *');
    header('Context-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Users.php';

    $database = new Database();
    $db = $database->Connect();

    $users = new Users($db);

    $users->username = isset($_GET['uname']) ? $_GET['uname'] : die();
    $users->password = isset($_GET['pwd']) ? $_GET['pwd'] : die();

    if($users->getUser()) {
        echo json_encode(array('messege' => 'yes'));
    }else{
        echo json_encode(array('messege' => 'no'));
    }
?>