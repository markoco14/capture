<?php
require_once __DIR__ . "/../_env.php";

$expected = $_ENV["CAPTURE_TOKEN"] ?? "";
$given = $_SERVER["HTTP_X_CAPTURE_TOKEN"] ?? "";

if ($expected === "" || !hash_equals($expected, $given)) {
    http_response_code(401);
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode([
        "status" => "error",
        "message" => "Not permitted"
    ]);
    exit;
}
