<?php
$action = $argv[1];

if ($action === 'add') {
    if (empty($argv[2])) {
        throw new Exception('You cannot create a task without description');
    }

    $jsonOriginal = file_get_contents('tasks.json');
    $content = json_decode($jsonOriginal, true);

    if ($content === null) {
        $content = [];
    }

    $ids = array_column($content, 'id');

    $maxId = !empty($ids) ? max($ids) : 0;

    $task = [
        "id" => $maxId + 1,
        "description" => $argv[2],
        "status" => "todo",
        "createdAt" => date("Y-m-d H:i:s"),
        "updatedAt" => date("Y-m-d H:i:s"),
    ];

    $content[] = $task;

    file_put_contents('tasks.json', json_encode($content, JSON_PRETTY_PRINT));
}
