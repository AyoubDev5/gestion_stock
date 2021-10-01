<?php
    ob_start();  //output buffering start     

       session_start();
       if(isset($_SESSION['Email'])){
              $nonavbar_log_reg='';
              include "init.php";
              $latest_fourni=latest("*","fournisseurs","Id_fourni");
              $latest_produit=latest("*","produits","Id_produit");
?>
              
               <div class="head-d text-center">
                    <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                    <h1>Dashboard</h1>
               </div>   
              <div class="container home-stat">
                 <div class="row text-center align-items-center">
                     <div class=" col-md-3">
                           <div class="stat st-memb">
                              Totale fournisseurs
                              <span><a href="fournisseurs.php"><?php echo count_items('Id_fourni','fournisseurs') ?></a></span>
                           </div>
                     </div>
                     <div class="col-md-3">
                          <div class="stat st-pend">
                               Totale services
                               <span><a href="services.php"><?php echo count_items('Id_service','services') ?></a></span>
                          </div>
                     </div>
                     <div class=" col-md-3">
                         <div class="stat st-itm">
                             Total categories
                             <span><a href="categories.php"><?php echo count_items('Id_categories','categories') ?></a></span>
                          </div>
                     </div>
                     <div class=" col-md-3">
                         <div class="stat st-com">
                             Total produits
                             <span><a href="produits.php"><?php echo count_items('Id_produit','produits') ?></a></span>
                          </div>
                     </div>
                  </div>   
              </div>
              <div class="container lat">
                    <div class="row">
                         <div class="col-md-4 ">
                              <ul class="list-group">
                                        <li class="list-group-item active" aria-current="true"> 
                                                  <i class="fa fa-users"></i>
                                                  Latest <?php echo count_items('Id_fourni','fournisseurs') ?> 
                                                  <?php 
                                                       if(count_items('Id_fourni','fournisseurs')==1 || count_items('Id_fourni','fournisseurs')==0)
                                                          echo "Fournisseur";
                                                       else
                                                            echo "Fournisseurs";    
                                                  ?>
                                        </li>
                                        <?php
                                               foreach($latest_fourni as $lat){  
                                                    echo "<li  class='list-group-item'>".$lat['Nom_fourni'];
                                                         echo "<a href='fournisseurs.php?do=Edit&Id_fourni=".$lat['Id_fourni']. "'";
                                                            echo "><button class='btn btn-success'>";
                                                                 echo "<i class='fa fa-edit'></i>Edit";
                                                            echo "</button>";
                                                         echo "</a>";
                                                    echo "</li>";
                                                    
                                               }
                                        ?>
                              </ul>
                         </div>
                         <div class="col-md-4 ms-auto">
                              <ul class="list-group">
                                        <li class="list-group-item active" aria-current="true"> 
                                             <i class="fa fa-tag"></i>
                                             Latest <?php echo count_items('Id_produit','produits') ?> 
                                                  <?php 
                                                       if(count_items('Id_produit','produits')==1 || count_items('Id_produit','produits')==0)
                                                          echo "produit";
                                                       else
                                                            echo "produits";    
                                                  ?>
                                        </li>
                                        <?php
                                               foreach($latest_produit as $lat){  
                                                    echo "<li  class='list-group-item'>".$lat['Nom_produit'];
                                                         echo "<a href='produits.php?do=Edit&Id_produit=".$lat['Id_produit']. "'";
                                                            echo "><button class='btn btn-success'>";
                                                                 echo "<i class='fa fa-edit'></i>Edit";
                                                            echo "</button>";
                                                         echo "</a>";
                                                    echo "</li>";
                                                    
                                               }
                                        ?>
                              </ul>
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
