<?php 
require "_db.php";
session_start();
?>

<?php
$stmt = $db->query("
    SELECT note_id, title, content FROM notes ORDER BY note_id DESC;
");
$notes = $stmt->fetchAll(PDO::FETCH_OBJ);

header("Content-Type: application/json");
echo json_encode($notes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); 
?>
