<?php
   // funtion for get title in page
   // function v1.0

   function printtitle($title){
      return $title;
   }

   // redirect into home dashboard
   // function v1.0

   function redirict_in_homeV1($error,$second){
          
         echo "<div class='alert alert-danger'>".$error."</div>";
         echo "<div class='alert alert-success'>Now you redirect at Dashboard page after ".$second." second</div>";

         header("refresh:$second;url=login.php");
         exit();
   }
    // redirect into home dashboard
   // function v2.0

   function redirict_in_homeV2($msg,$url=NULL,$second){

         if($url==NULL){
            $url="login.php";
            $link="Home page";
         }
         else{
            if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){  
                   $url = $_SERVER['HTTP_REFERER'];
                   $link="Previous page";
            }
            else{ 
                   $url="login.php";
                   $link="Home page";
            }       
         }
      echo $msg;
      echo "<div class='alert alert-info'>Now you redirect at ".$link." after ".$second." second</div>";

      header("refresh:$second;url=$url");
      exit();
   }

   // check items if username exist don't add at database
   // function v1.0

   function checkitems($select,$from,$value){
          global $connexion;

          $stat=$connexion->prepare("SELECT $select FROM $from WHERE $select=?");
          $stat->execute(array($value));
          $count=$stat->rowCount();

          return $count;

   }
   // count items userid in data base with function v1.0 
   
   function count_items($items,$table){

        // count userid in data base
         global $connexion;

        $st=$connexion->prepare("SELECT COUNT($items) FROM $table");
        $st->execute(array());

        $fetch=$st->fetchColumn();

        return $fetch;


   }

   //  latest items user function v1.0
   
   function latest($select,$table,$order){
      
      global $connexion;
         
      $st=$connexion->prepare("SELECT $select FROM $table ORDER BY $order DESC");
      $st->execute();

      $fetch=$st->fetchAll();

      return $fetch;
   }

?>