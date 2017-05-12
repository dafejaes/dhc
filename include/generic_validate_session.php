<?php
session_start();
if (!isset($_SESSION['usuario'])){
    header('Location: index.php');
}
include 'SessionData.php';
$SESSION_DATA = new SessionData();
?>