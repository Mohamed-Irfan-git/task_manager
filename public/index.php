<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Controlls\TaskController;
use App\Core\Database;

$config = require __DIR__ . '/../config/config.php';
$db = Database::connect($config['db']);
$controller = new TaskController($db);
$controller->handleRequest();
$tasks = $controller->getTask(); // also rename method to getTasks()

?>
<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Task Manager</h1>
<form method="POST">
    <input type="text" name="title" placeholder="Task title" required>
    <input type="text" name="description" placeholder="Task description">
    <button type="submit" name="add">Add Task</button>
</form>
<ul>
    <?php foreach ($tasks as $task): ?>
        <li class="<?= $task['status'] ?>">
            <strong><?= htmlspecialchars($task['title']) ?></strong> -
            <?= htmlspecialchars($task['description']) ?>
            [<?= $task['status'] ?>]
            <form method="POST" style="display:inline">
                <input type="hidden" name="id" value="<?= $task['id'] ?>">
                <button type="submit" name="complete">✔</button>
                <button type="submit" name="delete">🗑</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
</body>
</html>
