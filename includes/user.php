<?php
class User {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function register($username, $email, $password) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        // Insert the new user into the database
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $this->db->execute($sql, [
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ]);
    }

    public function login($username, $password) {
        // Fetch the user data based on the email
        $sql = "SELECT * FROM users WHERE username = :username";
        $user = $this->db->select($sql, ['username' => $username]);
        
        if ($user && password_verify($password, $user[0]['password'])) {
            // Password matches, user is authenticated
            return $user[0]; // You can also start a session or return a token here
        } else {
            // Authentication failed
            return false;
        }
    }

    public function get($id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        return $this->db->select($sql, ['id' => $id]);
    }
}
?>
