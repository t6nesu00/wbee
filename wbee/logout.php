<?php
    require './resources/config.php';
    session_destroy();

    header('Location: index.php');
?>