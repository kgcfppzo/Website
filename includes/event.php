<?php
class Event {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }
    public function get($id) {
        $sql = "SELECT * FROM events WHERE id = :id";
        $result = $this->db->select($sql, ['id'=> $id]);
        return $result ? $result[0] : null; 
    }
    public function update($id, $title, $description, $location, $datetime, $image, $link, $lifecycle) {
        $sql = "UPDATE events SET title = :title, description = :description, datetime = :datetime, location = :location, image_url = :image_url, link = :link, lifecycle = :lifecycle WHERE id = :id";
        $this->db->execute($sql, [
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'location' => $location,
            'datetime' => $datetime,
            'image_url' => $image,
            'link' => $link,
            'lifecycle' => $lifecycle
        ]);
    }
    public function getAll() {
        $sql = "SELECT * FROM events";
        return $this->db->select($sql);
    }
    public function getAvailableEvent(){
        $sql = "SELECT * FROM events WHERE lifecycle != :lifecycle ORDER BY datetime DESC  LIMIT 1";
        $result = $this->db->select($sql,['lifecycle' => 'ended']);
        return $result ? $result[0] : null;
    }
}
?>
