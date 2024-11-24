<?php
class Payment {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function create($description, $full_name, $amount, $currency, $charge_id, $token, $status) {
        $sql = "INSERT INTO payments (description, full_name, amount, currency, charge_id, token, status) VALUES (:description, :full_name, :amount, :currency, :charge_id, :token, :status)";
        $this->db->execute($sql, [
            'description' => $description,
            'full_name' => $full_name,
            'amount' => $amount,
            'currency' => $currency,
            'charge_id' => $charge_id,
            'token' => $token,
            'status' => $status
        ]);
    }

    public function getAll() {
        $sql = "SELECT * FROM payments";
        return $this->db->select($sql);
    }

    public function updateStatus($id){
        
    }
}
?>
