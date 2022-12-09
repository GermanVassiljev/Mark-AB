<?php
session_start();
if (!isset($_SESSION['tuvastamine'])) {
    header('Location: ab_login_Mark.php');
    exit();
}
if(isset($_POST['logout'])){
    session_destroy();
    header('Location: mark_andmed.php');
    exit();
}
?>
