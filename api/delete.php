<?php
require "../_db.php";
session_start();

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    $input = json_decode(file_get_contents("php://input"), true);
    $ids = $input["ids"] ?? [];

    if (empty($ids)) {
        http_response_code(422);
        echo json_encode([
            "status" => "error", 
            "message" => "No IDs provided to delete."
        ]);
        exit;
    }

    try {
        $clause = implode(",", array_fill(0, count($ids), "?"));
        $stmt = $db->prepare("DELETE FROM notes WHERE note_id IN ($clause)");
        $stmt->execute($ids);

        echo json_encode([
            "status" => "success",
            "message" => count($ids) . " notes successfully deleted." 
        ]);
        exit;
    
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            "status" => "error", 
            "message" => $e->getMessage()
        ]);
        exit;
    }

} else {
    http_response_code(405);
    echo json_encode([
        "status" => "error", 
        "message" => "Method not allowed. Please use DELETE."
    ]);
}
?>
