<?php
   ob_start();  //output buffering start  
   session_start(); //start session 
   
    if(isset($_SESSION['Email'])){
            $nonavbar_log_reg='';
            include "init.php";
   
        $do= isset($_GET['do']) ? $_GET['do']:"Manage"; 
               //start manage
            if($do=="Manage"){
                $order="asc";
                $order_array=array("asc","desc");
                if(isset($_GET['order']) && in_array($_GET['order'],$order_array)){
                  $order=$_GET['order'];
                }
    
             $statement=$connexion->prepare(
                                            "SELECT
                                                    bons.*,
                                                    services.Nom_client,
                                                    services.Nom_service
                                            FROM
                                                    bons
                                            INNER JOIN services ON services.Id_service = bons.Id_service
                                            ORDER BY Id_bon $order");
             $statement->execute();
              
             $take=$statement->fetchAll();
             if(!empty($take)){
?>
    <div class="head-d text-center">
                <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                <h1>Administre Bons</h1>
    </div>  
    <div class="container">
            <div class="table-responsive">
               <div class="main-table bgact list-group-item list-group-item-action active" aria-current="true">
                   <form class="order" action="?do=Recherche" method="POST">
                      <i class='icn fas fa-sort'></i>Order : 
                      <a class="<?php if($order=="asc") echo "active";?>" href="?order=asc">Asc</a> |
                      <a class="<?php if($order=="desc") echo "active";?>" href="?order=desc">Desc</a>
                      <input type="search" class="recher" name="recherche" id="recherche" placeholder="Search...">
                      <button class="btn btn-success" type="submit">Search</button>
                      <span class="refr refresh-bon">Refresh : <i class=" fas fa-redo-alt"></i></span>
                  </form> 
                </div> 
                <table class="main-table table text-center table-bordered">
                    <tr class="table-dark">
                        <td>Identifient de Bon</td>
                        <td>Nom de Client et service</td>
                        <td>Date</td>
                        <td>Control</td>
                    </tr>
                    <?php
                        foreach($take as $give){
                                echo"<tr>";
                                    echo "<td>".$give['Id_bon_nom'];
                                    echo "</td>";
                                    echo "<td>".$give['Nom_client']."-".$give['Nom_service']."</td>";
                                    echo "<td>".$give['Date']."</td>";
                                    echo "<td>
                                            <a href='bons.php?do=Edit&Id_bon=".$give['Id_bon']."' class='btn btn-sm btn-success'><i class='icn fa fa-edit'></i>Edit</a>
                                            <a href='bons.php?do=Delete&Id_bon=".$give['Id_bon']."' class='btn btn-sm btn-danger confirme'><i class='icn fas fa-minus-circle'></i>Delete</a>
                                            <a href='bons.php?do=Enter&Id_bon=".$give['Id_bon']."' class='btn btn-sm btn-info'><i class='icn fas fa-bars'></i>Enter</a>
                                            <a href='imprimer.php?Id_bon=".$give['Id_bon']."' class='btn btn-sm btn-primary'><i class='icn fas fa-print'></i>Imprimer</a>";  
                                    echo "</td>";
                                echo "</tr>";
                        }
                    ?>
                </table>
            </div>

      <a href='bons.php?do=Add' class="btn btn-sm btn-primary"><i class="icn fa fa-plus"></i>Nouveau Bon</a>
      <?php
            }
            else{
                echo " <div class='head-d text-center'>
                                        <img src='".$img."Logo bis.png' class='img-fluid'>
                                        <h1>Administre bon</h1>
                        </div>  ";
                echo "<div class='container'>";
                    echo "<div class='alert alert-danger'>Pas d'un bon</div>";
                    echo "<a href='bons.php?do=Add' class='btn btn-sm btn-primary'><i class='icn fa fa-plus'></i>Nouveau Bon</a>";
                echo "</div>";
            }
           ?>
</div>
<?php       
            }
            else if($do=="Recherche"){
                $id_bon_nom=$_POST['recherche'];
                $statement=$connexion->prepare("SELECT
                                                        bons.*,
                                                        services.Nom_client,
                                                        services.Nom_service
                                                FROM
                                                        bons
                                                INNER JOIN services ON services.Id_service = bons.Id_service 
                                                WHERE id_bon_nom='$id_bon_nom'");
                $statement->execute();
                $take=$statement->fetchAll(); 
                if(!empty($take)){
?>
                <div class="head-d text-center">
                            <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                            <h1>Administre Bons</h1>
                </div>  
                <div class="container">
                        <div class="table-responsive">
                           <div class="main-table bgact list-group-item list-group-item-action active" aria-current="true">
                               <form class="order" action="?do=Recherche" method="POST">
                                  <i class='icn fas fa-sort'></i>Order : 
                                  <a class="<?php if($order=="asc") echo "active";?>" href="?order=asc">Asc</a> |
                                  <a class="<?php if($order=="desc") echo "active";?>" href="?order=desc">Desc</a>
                                  <input type="search" class="recher" name="recherche" id="recherche" placeholder="Search...">
                                  <button class="btn btn-success" type="submit">Search</button>
                                  <span class="refr refresh-bon">Refresh : <i class=" fas fa-redo-alt"></i></span>
                              </form> 
                            </div> 
                            <table class="main-table table text-center table-bordered">
                                <tr class="table-dark">
                                    <td>Identifient de Bon</td>
                                    <td>Nom de Client et service</td>
                                    <td>Date</td>
                                    <td>Control</td>
                                </tr>
                                <?php
                                    foreach($take as $give){
                                            echo"<tr>";
                                                echo "<td>".$give['Id_bon_nom'];
                                                echo "</td>";
                                                echo "<td>".$give['Nom_client']."-".$give['Nom_service']."</td>";
                                                echo "<td>".$give['Date']."</td>";
                                                echo "<td>
                                                        <a href='bons.php?do=Edit&Id_bon=".$give['Id_bon']."' class='btn btn-sm btn-success'><i class='icn fa fa-edit'></i>Edit</a>
                                                        <a href='bons.php?do=Delete&Id_bon=".$give['Id_bon']."' class='btn btn-sm btn-danger confirme'><i class='icn fas fa-minus-circle'></i></i>Delete</a>
                                                        <a href='bons.php?do=Enter&Id_bon=".$give['Id_bon']."' class='btn btn-sm btn-info'><i class='icn fas fa-bars'></i>Enter</a>
                                                        <a href='imprimer.php?Id_bon=".$give['Id_bon']."' class='btn btn-sm btn-primary'><i class='icn fas fa-print'></i>Imprimer</a>";  
                                                echo "</td>";
                                            echo "</tr>";
                                    }
                                ?>
                            </table>
                        </div>
            
                  <a href='bons.php?do=Add' class="btn btn-sm btn-primary"><i class="icn fa fa-plus"></i>Nouveau Bon</a>
                  <?php
            }
            else{
                echo " <div class='head-d text-center'>
                                        <img src='".$img."Logo bis.png' class='img-fluid'>
                                        <h1>Administre bon</h1>
                        </div>  ";
                echo "<div class='container'>";
                    echo "<div class='alert alert-danger'>Pas d'un bon</div>";
                    echo "<a href='bons.php?do=Add' class='btn btn-sm btn-primary'><i class='icn fa fa-plus'></i>Nouveau Bon</a>";
                echo "</div>";
            }
           ?>
            </div>
<?php                       
            }
            else if($do=="Add"){
                          //add bon page 
?>
                          <div class="head-d text-center">
                              <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                              <h1>Ajouter Nouveau Bon</h1>
                          </div> 
                          <div class="container">
                              <form action="?do=Insert" method="POST">
                                      <!--for name produit -->
                                      <div class="mb-3 row">
                                          <label class="col-sm-2 col-form-label">Identifient de Bon</label>
                                          <div class="col-sm-10 col-md-4">
                                              <input class="form-control"
                                                      type="text"  
                                                      name="id_bon_nom" 
                                                      id="id_bon_nom" 
                                                      placeholder="Identifient de Bon" 
                                                      autocomplete="off">
                                          </div>
                                      </div>
                                      <!--for name Client - Service -->
                                      <div class="mb-3 row">
                                          <label for="description" class="col-sm-2 col-form-label">Client - Service</label>
                                          <div class="col-sm-10 col-md-4">
                                              <select name="service">
                                                <option value="0"></option>
                                                    <?php
                                                      $statement=$connexion->prepare("SELECT * FROM services");
                                                      $statement->execute();
                                                      $services=$statement->fetchAll();
                                                      foreach($services as $service){
                                                             echo "<option value='".$service['Id_service']."'>"
                                                                    .$service['Nom_client']."_".$service['Nom_service'];
                                                             echo "</option>";
                                                      }
                                                    ?>
                                            </select>
                                          </div>
                                      </div>
                                       <!--for Date-->
                                       <div class="mb-3 row">
                                          <label for="description" class="col-sm-2 col-form-label">Date</label>
                                          <div class="col-sm-10  col-md-4">
                                           <input type="date" class="form-control" name="datepicker" id="datepicker">
                                          </div>
                                      </div>
                                      <!--for validation -->
                                      <div class="mb-3 row"> 
                                          <div class="col-sm-10 offset-sm-2">
                                              <button class="btn btn-primary" type="submit">Ajouter Bon</button>
                                          </div>
                                      </div>     
                                 </form>
                              </div>
<?php                
            }
            else if($do=="Insert"){
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                            
                    echo " <div class='head-d text-center'>
                                <img src='".$img."Logo bis.png' class='img-fluid'>
                                <h1>Inserer Bon</h1>
                            </div>  ";
                    echo "<div class='container'>";   
                //get variable from here by mehtod post

                $id_bon_nom        =$_POST['id_bon_nom'];
                $id_client_service =$_POST['service'];
                $date              =$_POST['datepicker'];
        
                //validation required
    

                    //insert into in database
                  
                        $statement=$connexion->prepare(
                                                        "INSERT INTO bons(Id_bon_nom,Date,Id_service)
                                                        VALUES('$id_bon_nom','$date','$id_client_service');"
                                                        );
                        $statement->execute(array($id_bon_nom,$date,$id_client_service));
                        $compteur=$statement->rowCount(); 
                        if($compteur>0){
                            echo "<div class='alert alert-success'>Adding succefull</div>";
                            
                        }
                        else{ 
                            echo "<div class='alert alert-danger'>! Not Adding succefull</div>";
                            
                        }   
               
                
                }
                else{
                    echo "<div class='container'>";
                    echo "<div class='alert alert-danger'>Sorry! ,You can't directly in this page</div>";
                    
                    echo "</div>";
                } 

            echo "</div>";                  
            }
            else if($do=="Edit"){
                  //check method get if id is number and integer
                  $bonid=(isset($_GET['Id_bon']) && is_numeric($_GET['Id_bon'])) ? intval($_GET['Id_bon']) : "false";

                  // select the all data from user 
                  $statement=$connexion->prepare("SELECT * 
                                                     FROM  bons 
                                                     WHERE Id_bon=?");  
                  // execute query
                  $statement->execute(array($bonid));
                  // fetch data
                  $row=$statement->fetch();
                  // row data      
                         $compteur=$statement->rowCount();
                  // check if there is ID or not            
                if($compteur>0){  
?>

                            <div class="head-d text-center">
                              <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                              <h1>Editer Bon</h1>
                             </div> 
                    <div class="container">
                              <form action="?do=Update" method="POST">
                                 <input type="hidden" name="bonid" value="<?php echo $bonid ?>">
                                      <!--for name produit -->
                                      <div class="mb-3 row">
                                          <label class="col-sm-2 col-form-label">Identifient de Bon</label>
                                          <div class="col-sm-10 col-md-4">
                                              <input class="form-control"
                                                      type="text"  
                                                      name="id_bon_nom" 
                                                      id="id_bon_nom" 
                                                      placeholder="Identifient de Bon" 
                                                      autocomplete="off"
                                                      value="<?php echo $row['Id_bon_nom'] ?>">
                                          </div>
                                      </div>
                                      <!--for name Client - Service -->
                                      <div class="mb-3 row">
                                          <label for="description" class="col-sm-2 col-form-label">Client - Service</label>
                                          <div class="col-sm-10 col-md-4">
                                              <select name="service">
                                                <option value="0"></option>
                                                    <?php
                                                      $statement=$connexion->prepare("SELECT * FROM services");
                                                      $statement->execute();
                                                      $services=$statement->fetchAll();
                                                      foreach($services as $service){
                                                             echo "<option value='".$service['Id_service']."'";
                                                                   if($row['Id_service']==$service['Id_service'])
                                                                          echo "selected";
                                                                    
                                                             echo ">".$service['Nom_client']."_".$service['Nom_service']."</option>";
                                                      }
                                                    ?>
                                            </select>
                                          </div>
                                      </div>
                                       <!--for Date-->
                                       <div class="mb-3 row">
                                          <label for="description" class="col-sm-2 col-form-label">Date</label>
                                          <div class="col-sm-10  col-md-4">
                                           <input 
                                                  type="date" 
                                                  class="form-control" 
                                                  name="datepicker" 
                                                  id="datepicker"
                                                  value="<?php echo $row['Date'] ?>">
                                          </div>
                                      </div>
                                      <!--for validation -->
                                      <div class="mb-3 row"> 
                                          <div class="col-sm-10 offset-sm-2">
                                              <button class="btn btn-primary" type="submit">Mise à Jour Bon</button>
                                          </div>
                                      </div>     
                                 </form>
                    </div>
<?php
                }
                else{
                    echo "<div class='container'>";
                    echo "<div class='alert alert-danger'>Sorry! ,No Such ID here</div>";
                    
                    echo "</div>";
                }
                echo "</div>";
            }
            else if($do=="Update"){
                    echo " <div class='head-d text-center'>
                                          <img src='".$img."Logo bis.png' class='img-fluid'>
                                          <h1>Mise à Jour Bon</h1>
                                   </div>  ";
                     echo "<div class='container'>";         

                            if($_SERVER['REQUEST_METHOD'] == 'POST'){
             
                            //get variable from here by mehtod post
                            $id             =$_POST['bonid'];
                            $id_bon_nom     =$_POST['id_bon_nom'];
                            $client_service =$_POST['service'];
                            $date           =$_POST['datepicker'];
                           

                                   //update database  
                     
                                    $statement=$connexion->prepare("UPDATE bons
                                                                   SET Id_bon_nom = ?, Id_service = ?,Date = ?
                                                                    WHERE  Id_bon = ?");
                                   $statement->execute(array($id_bon_nom,$client_service,$date,$id));
                                   $compteur=$statement->rowCount(); 
                                   if($compteur>0){
                                           echo "<div class='alert alert-success'>Update succefull</div>";
                                          
                                   }
                                   else {
                                           echo "<div class='alert alert-danger'>! Not Update succefull</div>";   
                                          
                                   }            
                            
                            }
                            else{
                                   echo "<div class='alert alert-danger'>Sorry, You can't browse this page directly</div>";   
                                    
                            } 

                     echo "</div>";               
            }
            else if($do=="Delete"){
                 echo " <div class='head-d text-center'>
                                   <img src='".$img."Logo bis.png' class='img-fluid'>
                                   <h1>Supprimer Bon</h1>
                            </div>  ";
               echo "<div class='container'>";   
             //check method get if id categories is number and integer
                 $id=(isset($_GET['Id_bon']) && is_numeric($_GET['Id_bon'])) ? intval($_GET['Id_bon']) : "false";

                     $check=checkitems('Id_bon','bons',$id);

                     // check if there is ID or not            
                     if($check>0){
                                   //delete in database
                                   $statement=$connexion->prepare("DELETE
                                                               FROM bons 
                                                               WHERE Id_bon=$id;
                                                               ");  
                                   // execute query
                                   $statement->execute();

                                   echo  "<div class='alert alert-success'>Delete succefull</div>";
                                   
                                   
                     }
                     else{
                            echo  "<div class='alert alert-danger'>Is Not Exist</div>";
                            
                     }

                      echo "</div>";  
            }
            else if($do=="Enter"){  
                //check method get if id categories is number and integer
            
                $id_bon=(isset($_GET['Id_bon']) && is_numeric($_GET['Id_bon'])) ? intval($_GET['Id_bon']):"false";
                     // select the all data from user 
                                $statement=$connexion->prepare("SELECT * 
                                                                FROM  bons 
                                                                WHERE Id_bon=?");  
                            // execute query
                            $statement->execute(array($id_bon));
                            // fetch data
                            $row=$statement->fetch();
                            // row data      
                            $compteur=$statement->rowCount();
                            // check if there is ID or not            
                if($compteur>0){  
                    $id_join_affichage=$_GET['Id_bon'];
                                    $statement=$connexion->prepare(
                                                                "SELECT
                                                                    commandes_de_bons.*,
                                                                    produits.Nom_produit,
                                                                    produits.Quantité
                                                                FROM
                                                                    commandes_de_bons
                                                                INNER JOIN produits ON produits.Id_produit = commandes_de_bons.Id_produit
                                                                WHERE Id_bon_join='$id_join_affichage';
                                                                ");  
                  // execute query
                  $statement->execute();
                  // fetch data
                  $row=$statement->fetchAll();
                  // row data           
?>
                    <div class='head-d text-center'>
                            <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                            <h1>Commande de Produit</h1>
                    </div>
                    <div class='container'>
                            <form  method="POST">
                                      <!--for name produit -->
                                      <div class="mb-3 row">
                                          <label class="col-sm-2 col-form-label">Nom de Produit</label>
                                          <div class="col-sm-10 col-md-4">
                                          <select name="nom" id="qte">
                                                <option value="0"></option>
                                                    <?php
                                                      $statement=$connexion->prepare("SELECT * FROM produits");
                                                      $statement->execute();
                                                      $cmds=$statement->fetchAll();
                                                      foreach($cmds as $cmd){
                                                             echo "<option value='".$cmd['Id_produit']."'>"
                                                                  .$cmd['Nom_produit']."_".$cmd['Quantité']."</option>";           
                                                      }           
                                                    ?>
                                            </select>
                                          </div>
                                      </div>
                                      <!--for name quantite -->
                                      <div class="mb-3 row">
                                          <label for="description" class="col-sm-2 col-form-label">Quantité de Commande</label>
                                          <div class="col-sm-10 col-md-4">
                                             <input  class="form-control"
                                                     type="number"
                                                     id="qteresult" 
                                                     name="quantite" 
                                                     placeholder="Quantité De Commande" 
                                                >
                                          </div>
                                      </div>
                                      <!--for validation -->
                                      <div class="mb-3 row"> 
                                          <div class="col-sm-10 offset-sm-2">
                                              <button class="btn btn-primary" type="submit">Ajouter Commande</button>
                                          </div>
                                      </div>     
                            </form>
                    </div>
                <div class="container">
                    <div class="table-responsive">
                    <div class="main-table bgact list-group-item list-group-item-action active" aria-current="true">
                         <h2> 
                             N° BON: 
                             <?php 
                                if($_GET['Id_bon']){
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
                                }
                             ?>
                         </h2>
                        </div>
                        <?php
                           if(!empty($row)){
                        ?>
                        <table class="main-table table text-center table-bordered">
                            <tr class="table-dark">
                                <td>Identifient de Commande</td>
                                <td>Nom de Produit</td>
                                <td>Quantité de Commande</td>
                                <td>Control</td>
                            </tr>
                            <?php
                                foreach($row as $give){
                                        echo"<tr>";
                                            echo "<td>".$give['Id_CB']."</td>";
                                            echo "<td>".$give['Nom_produit']."</td>";
                                            echo "<td>";
                                                    if($give['Quantité_cmd']<=$give['Quantité']){
                                                        echo $give['Quantité_cmd'];
                                                    }
                                                    else echo "Quantité Insuffisante ";
                                            echo "</td>";
                                            echo "<td>  
                                                    <a href='bons.php?do=Delete_cb&Id_CB=".$give['Id_CB']."' class='btn btn-sm btn-danger confirme'><i class='icn fas fa-minus-circle'></i>Delete</a>";  
                                            echo "</td>";
                                        echo "</tr>";
                                }
                            ?>
                        </table>
                        <?php
                           }
                           else{
                            echo "<div class='alert alert-danger'>Pas d'un commande</div>";
                           }
                        ?>
                    </div>
                </div>   
<?php          
    
                   if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $id_join=$_GET['Id_bon'];   
                    $id_produit        =$_POST['nom'];
                    $quantite          =$_POST['quantite'];

                        //insert into in database

                    $statement=$connexion->prepare(
                                                    "INSERT INTO commandes_de_bons(Quantité_cmd,Id_produit,Id_bon_join)
                                                    VALUES('$quantite','$id_produit','$id_join');"
                                                    );
                    $statement->execute(array($quantite,$id_produit,$id_join));  
                    header("refresh:1");
                    exit();
                   }
                }
            }
            else if($do=="Delete_cb"){
                 echo " <div class='head-d text-center'>
                                   <img src='".$img."Logo bis.png' class='img-fluid'>
                                   <h1>Supprimer Commande</h1>
                            </div>  ";
               echo "<div class='container'>";   
             //check method get if id categories is number and integer
                 $id=(isset($_GET['Id_CB']) && is_numeric($_GET['Id_CB'])) ? intval($_GET['Id_CB']) : "false";

                                   //delete in database
                                   $statement=$connexion->prepare("DELETE
                                                               FROM commandes_de_bons 
                                                               WHERE Id_CB=$id;
                                                               ");  
                                   // execute query
                                   $statement->execute();

                                   echo  "<div class='alert alert-success'>Delete succefull</div>";
                                   
                                   header("Refresh:1");
                                   exit();
                                   
                    

                    echo "</div>";  
            }

        include $tpl."footer.php";        
    }
    else{
        header('Location:login.php');  
        exit();
    }
    
    ob_end_flush(); //output beffring end  
?>