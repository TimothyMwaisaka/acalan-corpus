<?php
    session_start(); 
    unset($_SESSION['uName']);   
    session_destroy();
    header('location:/swahilicorpus/index.php');
    session_write_close();
    header('Location: /swahilicorpus');
    die;
?>