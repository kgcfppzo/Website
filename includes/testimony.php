<?php
class Testimony {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function create($name, $title, $content) {
        $sql = "INSERT INTO testimonies (name, title, content) VALUES (:name, :title, :content)";
        $this->db->execute($sql, [
            'name' => $name,
            'title' => $title,
            'content' => $content
        ]);
    }

    public function remove($id){
        $sql = "UPDATE testimonies SET visibility = null WHERE id = :id";
        return $this->db->execute($sql, ['id' => $id]);
    }
    public function show($id){
        $sql = "UPDATE testimonies SET visibility = :visibility WHERE id = :id";
        return $this->db->execute($sql, ['id' => $id, 'visibility' => true]);
    }

    public function delete($id) {
        $sql = "DELETE FROM testimonies WHERE id = :id";
        $this->db->execute($sql, ['id' => $id]);
    }

    public function getAll() {
        $sql = "SELECT * FROM testimonies";
        return $this->db->select($sql);
    }

    public function getAllShow(){
        $sql = "SELECT * FROM testimonies WHERE visibility = 1";
        return $this->db->select($sql);
    }
}

?>
