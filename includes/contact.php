<?php
class Contact {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function create($full_name, $email, $subject, $message) {
        $sql = "INSERT INTO contacts (full_name, email, subject, message) VALUES (:full_name, :email, :subject, :message)";
        $this->db->execute($sql, [
            'full_name' => $full_name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM contacts WHERE id = :id";
        $this->db->execute($sql, ['id' => $id]);
    }

    public function getAll() {
        $sql = "SELECT * FROM contacts";
        return $this->db->select($sql);
    }
}
?>
