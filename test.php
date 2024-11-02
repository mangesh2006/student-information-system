<?php
header('Content-Type: application/json');

$data = [
    "name"=> "mangesh",
    "age"=> "18"
];

echo json_encode($data);