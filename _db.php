<?php

require __DIR__ . "/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

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
