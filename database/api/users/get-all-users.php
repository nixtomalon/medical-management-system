<?php

    header('Access-Control-Allow-Origin: *');
    header('Context-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Users.php';

    $database = new Database();
    $db = $database->Connect();

    $users = new Users($db);

    $result = $users->getAllUsers();

    if($result->rowCount() > 0) {
        $users_arr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
    
            $user_item = array(
                'user_id' => $user_id,
                'username' => $username,
                'password' => $password,
                'fullname' => $fullname,
            );
            array_push($users_arr, $user_item);
        }
        echo json_encode($users_arr);
    }else{
        echo json_encode(array('messege' => 'Not available'));
    }
?>