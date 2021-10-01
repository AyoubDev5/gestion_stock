<?php
    //connexion
    include "connexion.php";
    //Root
    $tpl= "../Include/Templates/"; //Templates Directory
    $fun= "../Include/Function/"; //Functions Directory
    $css= "../Design/css/"; //Css Directory
    $img= "../Design/images/"; //Css Directory
    $js = "../Design/js/"; //js Directory

     // FILES IMPORTANAT!!!!
    
     include $fun."function.php";
     include $tpl."header.php";
     
    
     // exception navbar page
     
      if(!isset($nonavbar))  include $tpl."nav-bar.php"; 

      if(!isset($nonavbar_log_reg)) include $tpl."navbar-log-reg.php";

?>