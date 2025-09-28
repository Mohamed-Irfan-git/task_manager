<?php

namespace App\Model;
use PDO;
class Task{

    private PDO $db;
    private string $table = 'tasks';

    public function __construct(PDO $db){
        $this->db = $db;
    }

    public function all(){
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();

    }

    public function create(string $title, string $description){
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (title, description) VALUES (?, ?)");
        return $stmt->execute([$title, $description]);
    }


    public function complete(int $id){
        $stmt = $this->db->prepare("UPDATE tasks SET status = 'done' WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function delete(int $id){
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

}