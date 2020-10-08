<?php

class Medicines {

    public $conn;
    public $table = 'medicines';

    public $med_id;
    public $med_name;
    public $med_brand;
    public $miligram;
    public $exp_date;
    public $stock;
    public $status = TRUE;
    public $query_data;
    public $med_item;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllMedicine() {
        $query = 'SELECT * FROM medicines WHERE status = ?';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->status);
        $stmt->execute();

        return $stmt;
    }

    public function getMedicine() {

        $query = "SELECT * FROM medicines WHERE med_name LIKE '%".$this->query_data."%' AND status = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->status);
        $stmt->execute();

        return $stmt;
    }

    public function subtractMedStock() {

        for($i = 0 ; $i < count($this->med_item) ; $i++) {
            $query = 'SELECT * FROM '.$this->table.' WHERE med_id = ? AND status = ?'; // get specific medicine

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->med_item[$i]->medid);
            $stmt->bindParam(2,$this->status);
            if($stmt->execute()){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $newStock = intval($row['stock']) - intval($this->med_item[$i]->medquan);

                // update medicine stock
                $query1 = 'UPDATE '.$this->table.' SET stock = ? WHERE med_id = ?';

                $stmt1 = $this->conn->prepare($query1);
                $stmt1->bindParam(1,$newStock);
                $stmt1->bindParam(2,$row['med_id']);
                if(!$stmt1->execute()){
                    return false;
                }
            }
        }
        return true;
    }

    public function newMedicine() {
        $query = 'INSERT INTO '.$this->table.' (med_name, med_brand, miligram, exp_date, stock, status) VALUES (:medname, :medbrand, :miligram, :expdate, :stock, :status)';

        $stmt = $this->conn->prepare($query);

        $this->med_name = htmlspecialchars(strip_tags($this->med_name));
        $this->med_brand = htmlspecialchars(strip_tags($this->med_brand));
        $this->miligram = htmlspecialchars(strip_tags($this->miligram));
        $this->exp_date = htmlspecialchars(strip_tags($this->exp_date));
        $this->stock = htmlspecialchars(strip_tags($this->stock));

        $stmt->bindParam(':medname',$this->med_name);
        $stmt->bindParam(':medbrand',$this->med_brand);
        $stmt->bindParam(':miligram',$this->miligram);
        $stmt->bindParam(':expdate',$this->exp_date);
        $stmt->bindParam(':stock',$this->stock);
        $stmt->bindParam(':status',$this->status);

        if($stmt->execute()) {
            return true;
        }else {
            return false;
        }
    }

    public function updateMedicine() {
        $query = 'UPDATE '.$this->table.' SET med_name = ? , med_brand = ? , miligram = ? , exp_date = ?, stock = ? WHERE med_id = ?';

        $stmt = $this->conn->prepare($query);

        $this->med_name = htmlspecialchars(strip_tags($this->med_name));
        $this->med_brand = htmlspecialchars(strip_tags($this->med_brand));
        $this->miligram = htmlspecialchars(strip_tags($this->miligram));
        $this->exp_date = htmlspecialchars(strip_tags($this->exp_date));
        $this->stock = htmlspecialchars(strip_tags($this->stock));

        $stmt->bindParam(1,$this->med_name);
        $stmt->bindParam(2,$this->med_brand);
        $stmt->bindParam(3,$this->miligram);
        $stmt->bindParam(4,$this->exp_date);
        $stmt->bindParam(5,$this->stock);
        $stmt->bindParam(6,$this->med_id);

        if($stmt->execute()) {
            return true;
        }else {
            return false;
        }
    }

    public function removeMedicine(){
        $query = 'UPDATE '.$this->table.' SET status=false WHERE med_id = ?';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1,$this->med_id);
        
        if($stmt->execute()) {
            return true;
        }else{
            return false;
        }
    }
}

?>