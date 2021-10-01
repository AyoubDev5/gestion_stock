<?php
 ob_start();  //output buffering start  
 session_start(); //start session 
 
  if(isset($_SESSION['Email'])){
          $nonavbar_log_reg='';
          $nonavbar='';
          include "init.php";

?>          
            <div class='head-d text-center'>
                        <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                        <h1>FACULTE DES SCIENCES DHAR EL MAHRAZ FES</h1>
                        <h2>MAGASIN</h2>
                        <h3>BON DE LIVRAISON N°: 
                        <?php
                               $id=$_GET['Id_bon'];
                                $statement=$connexion->prepare(
                                    "SELECT
                                               Id_bon_nom
                                                
                                    FROM
                                                bons
                                   
                                    WHERE Id_bon='$id';
                                    ");
                                $statement->execute();
                                $take= $statement->fetchAll();
                                foreach($take as $give){
                                    echo $give['Id_bon_nom'];
                                }
                        ?>
                        </h3><br><br>
            </div>

            <div class="container">
                <div>
                <?php
                 $id=$_GET['Id_bon'];
                                $statement=$connexion->prepare(
                                                                "SELECT
                                                                            bons.*,
                                                                            services.Nom_client,
                                                                            services.Nom_service
                                                                FROM
                                                                            bons
                                                                INNER JOIN services ON services.Id_service = bons.Id_service
                                                        
                                                                 WHERE  Id_bon='$id';        
                                                                ");
                                $statement->execute();
  
                                $take=$statement->fetchAll();
                                foreach ($take as $give) {
                                    echo"<span>Nom du Service : <b>".$give['Nom_service']."</b></span>";
                                }
                ?>
                </div>
                <div>
                <?php
                          $id_for_print=$_GET['Id_bon'];
                                $statement=$connexion->prepare(
                                                                "SELECT
                                                                            bons.*,
                                                                            services.Nom_client,
                                                                            services.Nom_service
                                                                FROM
                                                                            bons
                                                                INNER JOIN services ON services.Id_service = bons.Id_service
                                                                WHERE Id_bon='$id_for_print';
                                                                ");
                                $statement->execute();
  
                                $take=$statement->fetchAll();
                                foreach ($take as $give) {
                                    echo"<span>Nom du demandeur :<b> ".$give['Nom_client']."</b></span>";
                                }
                                if($_GET['Id_bon']){
                                    $id_for_print=$_GET['Id_bon'];
                                    $statement=$connexion->prepare(
                                                                    "SELECT
                                                                            commandes_de_bons.*,
                                                                            produits.Nom_produit
                                                                            
                                                                    FROM
                                                                             commandes_de_bons
                                                                    INNER JOIN produits ON produits.Id_produit = commandes_de_bons.Id_produit
                                                                    WHERE Id_bon_join='$id_for_print';
                                                                    ");
                                    $statement->execute();
      
                                    $take=$statement->fetchAll();
                ?>
                </div>
                <div class="table-responsive">
                    <table class="main-table table text-center table-bordered">
                        <tr class="table-dark">
                            <td class="">Designations</td>
                            <td>Quantité Livrées</td>
                            <td>Observation</td>
                        </tr>
                        <?php
                                
                                foreach ($take as $give) {
                                  echo "<tr>";
                                    echo "<td>".$give['Nom_produit'];
                                  echo "</td>";
                                  echo "<td>".$give['Quantité_cmd'];
                                  echo "</td>";          
                                  echo "</tr>";     
                                }
                            }
                        ?>
                    </table>      
                </div>
                <div class="row justify-content-between">
                        <div class="col-4">
                             <span>Signature du responsable</span>
                        </div>
                        <div class="col-4">
                                 <span>Fés, le 
                                 <?php
                                     $id=$_GET['Id_bon'];
                                      $statement=$connexion->prepare(
                                        "SELECT
                                                   Date
                                                    
                                        FROM
                                                    bons
                                       
                                        WHERE Id_bon='$id';
                                        ");
                                    $statement->execute();
                                    $take= $statement->fetchAll();
                                    foreach($take as $give){
                                        echo $give['Date'];
                                    }
                                 ?>
                                 </span>
                        </div>
                </div>
            </div>
<?php


        include $tpl."footer.php";      
    }
    else{
        header('Location:login.php');  
        exit();
    }

    ob_end_flush(); //output beffring end
?>            