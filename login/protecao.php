<?php

if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if(!isset($_SESSION['id'])) {
    
    header("location: login/login.php");
    exit;
}
?>