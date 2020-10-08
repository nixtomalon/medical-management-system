<?php

session_start();

class Users{
    public $conn;
    public $table = 'users';

    public $user_id;
    public $username;
    public $password;
    public $fullname;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getUser() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE username = ? AND password = ?';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->username);
        $stmt->bindParam(2,$this->password);
        $stmt->execute();

        if(!$stmt->rowCount()) {
            return false;
        }else{ 
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['id'] = $row['user_id'];
            $_SESSION['fname'] = $row['fullname'];

            return true;
        }
    }

    public function getAllUsers() {
        $query = 'SELECT * FROM '.$this->table.' ORDER BY user_id';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
}

?>