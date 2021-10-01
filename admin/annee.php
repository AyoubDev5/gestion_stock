<?php
 ob_start();  //output buffering start  
 session_start(); //start session 
 
  if(isset($_SESSION['Email'])){
          $nonavbar_log_reg='';
          $nonavbar='';
          include "init.php";

            $date=$_GET['recherche'];
                $statement=$connexion->prepare("SELECT
                                                         bons.*,
                                                         services.Nom_client,
                                                         services.Nom_service
                                                FROM
                                                        bons
                                                INNER JOIN services ON services.Id_service = bons.Id_service
                                                WHERE        YEAR(Date)='$date'");
                $statement->execute();
                $take=$statement->fetchAll();
?>
            <div class='head-d text-center'>
                    <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                    <h1>FACULTE DES SCIENCES DHAR EL MAHRAZ FES</h1>
                    <h3>MAGASIN</h3>
                    <h2>État de Stock de l'année  
                            <?php   
                                    echo $date; 
                            ?>
                    </h2>
            </div>
            <div class="container">
                <div class="table-responsive">
                    <table class="main-table table text-center table-bordered">
                        <tr class="table-dark">
                            <td class="col-2">Identifient de bon</td>
                            <td class="col-7">Nom de client et Service</td>
                            <td class="col-3">Date</td>
                        </tr>
                        <?php
                                
                                foreach ($take as $give) {
                                  echo "<tr>";
                                    echo "<td>".$give['Id_bon_nom'];
                                  echo "</td>";
                                  echo "<td>".$give['Nom_client']."_".$give['Nom_service'];
                                  echo "</td>";
                                  echo "<td>".$give['Date'];
                                  echo "</td>";          
                                  echo "</tr>";     
                                }
                        ?>
                    </table>      
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