<?php

session_start();

include("../includes/header.php");


session_unset();


session_destroy();

header('Location: ' . BASE_URL . '/index.php');
?>