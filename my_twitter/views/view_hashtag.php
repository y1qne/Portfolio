<?php require_once('view_header.php'); ?>
<?php require_once('view_nav.php'); ?>
<?php
if (isset($_GET['pseudo'])) {
    $pseudo = $_GET['pseudo'];
} else {
    header('Location: /');
    exit;
}

echo "#$pseudo";
