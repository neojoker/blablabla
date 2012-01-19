<?php
session_start();
unset($_SESSION['ultimo_id']);
$_SESSION['ultimo_id'] = $_POST['q'];
?>