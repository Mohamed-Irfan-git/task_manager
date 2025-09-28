<?php

namespace App\Controlls;

use App\Model\Task;
use PDO;

class TaskController{
    private Task $task;

    public function __construct(PDO $db){
        $this->task = new Task($db);
    }

    public function handleRequest(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['add'])){
                $this->task->create($_POST['title'], $_POST['description']);
            }

            if (isset($_POST['complete'])) {
                $this->task->complete((int)$_POST['id']);
            }
            if (isset($_POST['delete'])) {
                $this->task->delete((int)$_POST['id']);
            }
            header("Location: index.php");
            exit;
        }
    }

    public function getTask(): array{
       return $this->task->all();
    }

}