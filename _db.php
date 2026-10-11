<?php

require_once __DIR__ . "/_env.php";

$db = new PDO("sqlite:" . $_ENV["CAPTURE_DB_PATH"]);

$db->exec("
    CREATE TABLE IF NOT EXISTS notes(
        note_id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        content TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME
    );
");
?>
