<?php
   $dsn="mysql:host=localhost;dbname=gestion de stock";
   $user="root";
   $password="";
   $option=array(
       PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
   );
   try{
      global $connexion;
      $connexion= new PDO($dsn,$user,$password,$option);
      $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      //  echo 'connected';
   }
   catch(PDOException $e){
      $e->getMessage();
   }

?>