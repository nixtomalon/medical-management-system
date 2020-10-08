<?php

class Patient {

    public $conn;
    public $table = 'patients';

    public $patient_id;
    public $fullname;
    public $address;
    public $birthdate;
    public $gender;
    public $number;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function searchPatient() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE patient_id = ?';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->patient_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->patient_id = $row['patient_id'];
        $this->fullname = $row['fullname'];
        $this->birthdate = $row['birthdate'];
        $this->address = $row['address'];
        $this->gender = $row['gender'];
        $this->number = $row['contact_number'];
    }

    public function newPatient() {
        $query = 'INSERT INTO '. $this->table .' (fullname, address, birthdate, gender, contact_number) VALUES (:fullname, :address, :birthdate, :gender, :number)';

        $stmt = $this->conn->prepare($query);

        $this->fullname = htmlspecialchars(strip_tags($this->fullname));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->birthdate = htmlspecialchars(strip_tags($this->birthdate));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->number = htmlspecialchars(strip_tags($this->number));

        $stmt->bindParam(':fullname',$this->fullname);
        $stmt->bindParam(':address',$this->address);
        $stmt->bindParam(':birthdate',$this->birthdate);
        $stmt->bindParam(':gender',$this->gender);
        $stmt->bindParam(':number',$this->number);

        if($stmt->execute()) {
            return true;
        }else {
            return false;
        }
    }

    public function getAllPatient() {
        $query = 'SELECT * FROM '.$this->table.' ORDER BY patient_id';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    public function updatePatient() {
        $query = 'UPDATE '.$this->table.' SET fullname = ? , address = ? , gender = ? , birthdate = ?, contact_number = ? WHERE patient_id = ?';

        $stmt = $this->conn->prepare($query);

        $this->fullname = htmlspecialchars(strip_tags($this->fullname));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->birthdate = htmlspecialchars(strip_tags($this->birthdate));
        $this->number = htmlspecialchars(strip_tags($this->number));

        $stmt->bindParam(1,$this->fullname);
        $stmt->bindParam(2,$this->address);
        $stmt->bindParam(3,$this->gender);
        $stmt->bindParam(4,$this->birthdate);
        $stmt->bindParam(5,$this->number);
        $stmt->bindParam(6,$this->patient_id);

        if($stmt->execute()) {
            return true;
        }else {
            return false;
        }
    }
}
?>