<?php
     session_start(); // start session
     session_unset(); // unset data
     session_destroy(); // destroy session

     header('Location: index.php');
     exit();
?>