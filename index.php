<?php
require "_db.php";
session_start();
?>

<?php
$stmt = $db->query("
    SELECT note_id, title, content FROM notes ORDER BY note_id DESC;
");
$notes = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

<?php require "_header.php"; ?>
<h1>Captive</h1>
<p>Capture notes, pull notes, act on notes.</p>                                                             
<ul>
<?php foreach ($notes as $note): ?>    
<li class="note">
    <h2><?= htmlspecialchars($note->title) ?></h2>
    <p><?=htmlspecialchars($note->content) ?></p>
</li>
<?php endforeach; ?>
</ul>

<?php
if (isset($_SESSION['flash_message'])) {
    $flash = $_SESSION['flash_message'];

    require "_flash.php";

    unset($_SESSION['flash_message']);
}
?>

<?php require "_footer.php"; ?>

