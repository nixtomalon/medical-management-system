<?php

class Prescription {
    public $conn;
    public $table = 'prescriptions';

    public $diagnose_id;
    public $med_id;
    public $quantity;

    public $pres_item;
    public $counter = 0;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function  newPrescription() {
        for($i = 0 ; $i < count($this->pres_item) ; $i++) {
            $query = 'INSERT INTO '.$this->table.' (diagnose_id, med_id, quantity) VALUES (:diagnose_id, :med_id, :quantity)';
 
            $stmt = $this->conn->prepare($query);

            $this->diagnose_id = htmlspecialchars(strip_tags($this->diagnose_id));
            $this->med_id = htmlspecialchars(strip_tags($this->pres_item[$i]->medid));
            $this->quantity = htmlspecialchars(strip_tags($this->pres_item[$i]->medquan));

            $stmt->bindParam(':diagnose_id', $this->diagnose_id);
            $stmt->bindParam(':med_id', $this->med_id);
            $stmt->bindParam(':quantity', $this->quantity);

            if(!$stmt->execute()) {
               return false;
            }
        }
        return true;
    }

    public function getPrescription() {
        $query = 'SELECT med_name, med_brand, miligram, quantity FROM '.$this->table.' JOIN diagnose_details USING(diagnose_id) JOIN medicines USING (med_id) WHERE diagnose_id = ? ORDER BY date';
    
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1,$this->diagnose_id);

        $stmt->execute();
        return $stmt;
    }

}

?>