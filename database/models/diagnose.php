<?php

class Diagnose {

    public $conn;
    public $table = 'diagnose_details';

    public $patient_id;
    public $date;
    public $diagnose;

    public $currDiag;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function newDiagnose() {
        $query = 'INSERT INTO '. $this->table .'(patient_id,date,diagnose) VALUES (:patient_id, :date, :diagnose)';

        $stmt = $this->conn->prepare($query);
        $this->patient_id = htmlspecialchars(strip_tags($this->patient_id));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->diagnose = htmlspecialchars(strip_tags($this->diagnose));

        $stmt->bindParam(':patient_id', $this->patient_id);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':diagnose', $this->diagnose);

        if($stmt->execute()) {
            return true;
        }else{
            return false;
        }
    }

    public function getCurrentDiagId() {
        $query = 'SELECT diagnose_id FROM '. $this->table .' ORDER BY diagnose_id DESC LIMIT 1';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getDiagnose() {
        $query = 'SELECT * FROM '.$this->table.' WHERE patient_id = ? ORDER BY diagnose_id';

        $stmt = $this->conn->prepare($query);   
        $stmt->bindParam(1,$this->patient_id);
        $stmt->execute();
        return $stmt;
    }

    public function getAllDiagnose() {
        $query = 'SELECT * FROM '.$this->table.' ORDER BY diagnose_id';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    public function getAllDiagnoseAndPatient() {
        $query = 'SELECT patient_id, diagnose_id, fullname, contact_number, diagnose, date FROM patients JOIN '.$this->table.' USING(patient_id)';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }

}