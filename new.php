<?php
require "_db.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $note = $_POST['note'] ?? '';

    $stmt = $db->prepare("
        INSERT INTO notes (title, content) VALUES (:title, :content);
    ");
    
    $stmt->execute([
        "title" => $title,
        "content" => $note
    ]);
    
    $_SESSION['flash_message'] = [
        "note_stored" => "Note saved"
    ]; 

    http_response_code(303);
    header("Location: /index.php");
    exit();
}
?>

<?php require "_header.php"; ?>
<h1>New Note</h1>
<form action="/new.php" method="POST">
    <div class="input-group">
        <label for="title">Title</label>
        <input id="title" name="title" type="text"/>
    </div>
    <div class="input-group">
        <label for="note">Note</label>
        <textarea id="note" name="note"></textarea>
    </div>
    <button type="submit">Save note</button>
</form>
<?php require "_footer.php"; ?>
