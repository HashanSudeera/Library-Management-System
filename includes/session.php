<?php

session_start();

include 'db_config.php';

// CHECK USER LOGGED IN
if(!isset($_SESSION['user_id'])){

    header("Location: ./index.php");

    exit();

}

?>