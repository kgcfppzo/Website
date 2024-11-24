<?php
class Stat {
    private $db;
    private $table;
    private $today;
    public function __construct(Database $db) {
        $this->db = $db;
        $this->table = 'stats';
        $this->today = date("Y-m-d") ;
    }

    private function create($page) {
        $sql = "INSERT INTO $this->table (date, visitor_count, page) VALUES (:date, :visitor_count, :page)";
        $this->db->execute($sql, [
            'date' => $this->today,
            'visitor_count' => 1,
            'page' => $page,
        ]);
    }

    private function update($id, $count) {
        $sql = "UPDATE $this->table SET visitor_count = :visitor_count WHERE id = :id";
        $this->db->execute($sql, [
            'id' => $id,
            'visitor_count' => $count + 1
        ]);
    }

    public function getAll() {
        $sql = "SELECT * FROM $this->table ORDER BY date DESC";
        return $this->db->select($sql);
    }

    public function getAllByPage($page) {
        $sql = "SELECT * FROM $this->table WHERE page = :page";
        return $this->db->select($sql, ['page' => $page]);
    }

    public function getByPageDate($page, $date){
        $sql = "SELECT * FROM $this->table WHERE page = :page AND date = :date";
        $result = $this->db->select($sql, ['page' => $page, 'date' => $date]);
        return $result ? $result[0] : null;
    }
    public function add($page){
        $result = $this->getByPageDate($page, $this->today);
        if ($result) {
            $id = $result['id'];
            $visitorCount = $result['visitor_count'];
            $this->update($id, $visitorCount);
        } else {
            $this->create($page);
        }
    }
}
?>
