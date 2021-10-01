<?php
 ob_start();  //output buffering start  
 session_start(); //start session 
 
  if(isset($_SESSION['Email'])){
          $nonavbar_log_reg='';
          include "init.php";
         
                        $statement=$connexion->prepare(
                                                        "SELECT
                                                               *
                                  
                                                        FROM
                                                                bons
                                                        ");
                        $statement->execute();

                        $take=$statement->fetchAll();
?>          
            <div class='head-d text-center'>
                        <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                        <h1>FACULTE DES SCIENCES DHAR EL MAHRAZ FES</h1>
                        <h3>MAGASIN</h3>
                        <h3>ÉTAT DE STOCK</h3>
            </div>
            <form class="etat" action="annee.php">
                <input class="form-control" type="number" name="recherche" placeholder="chercher un année">
                <input class="btn btn-md btn-success" type="submit" name="submit" value="Recherche l'année">
            </form>
<?php
        
        include $tpl."footer.php";      
    }
    else{
        header('Location:login.php');  
        exit();
    }

    ob_end_flush(); //output beffring end
?>            