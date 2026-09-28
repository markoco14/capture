<?php
require "_db.php";
session_start();
?>

<?php require "_header.php"; ?>
<h1>hello world</h1>
<p>The greatest capture site of all time.</p>                                                             
<p>There will be a list of notes here</p>

<?php
$stmt = $db->query("
    SELECT note_id, title, content FROM notes ORDER BY note_id DESC;
");
$notes = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

<?php foreach ($notes as $note): ?>    
    <h2><?= htmlspecialchars($note->title) ?></h2>
    <p><?=htmlspecialchars($note->content) ?></p>
<?php endforeach; ?>

<?php
if (isset($_SESSION['flash_message'])) {
    $flash = $_SESSION['flash_message'];

    require "_flash.php";

    unset($_SESSION['flash_message']);
}
?>

<?php require "_footer.php"; ?>

