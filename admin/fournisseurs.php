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

         $statement=$connexion->prepare("SELECT * FROM fournisseurs ORDER BY Id_fourni $order");
         $statement->execute();
          
         $take=$statement->fetchAll();
         if(!empty($take)){
?>
         <div class="head-d text-center">
                     <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                     <h1>Administre Fournisseurs</h1>
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
                           <span class="refr refresh-fourni">Refresh : <i class=" fas fa-redo-alt"></i></span>
                       </form> 
                     </div> 
                     <table class="main-table table text-center table-bordered">
                         <tr class="table-dark">
                             <td>#ID</td>
                             <td>Nom de Fournisseur</td>
                             <td>Address</td>
                             <td>Téléphone</td>
                             <td>ICE</td>
                             <td>Control</td>
                         </tr>
                         <?php
                             foreach($take as $give){
                                     echo"<tr>";
                                         echo "<td>".$give['Id_fourni']."/".date("Y");
                                         echo "</td>";
                                         echo "<td>".$give['Nom_fourni']."</td>";
                                         echo "<td>".$give['Address']."</td>";
                                         echo "<td>".$give['Téléphone']."</td>";
                                         echo "<td>".$give['ICE']."</td>";
                                         echo "<td>
                                                 <a href='fournisseurs.php?do=Edit&Id_fourni=".$give['Id_fourni']."' class='btn btn-sm btn-success'><i class='icn fa fa-edit'></i>Edit</a>
                                                 <a href='fournisseurs.php?do=Delete&Id_fourni=".$give['Id_fourni']."' class='btn btn-sm btn-danger confirme'><i class='icn fas fa-minus-circle'></i>Delete</a>";  
                                         echo "</td>";
                                     echo "</tr>";
                             }
                         ?>
                     </table>
                 </div>
           <a href='fournisseurs.php?do=Add' class="btn btn-sm btn-primary"><i class="icn fa fa-plus"></i>Nouveau fournisseur</a>
           <?php
            }
            else{
                echo " <div class='head-d text-center'>
                                        <img src='".$img."Logo bis.png' class='img-fluid'>
                                        <h1>Administre Fournisseur</h1>
                        </div>  ";
                echo "<div class='container'>";
                    echo "<div class='alert alert-danger'>Pas d'un fournisseur</div>";
                    echo "<a href='fournisseurs.php?do=Add' class='btn btn-sm btn-primary'><i class='icn fa fa-plus'></i>Nouveau fournisseur</a>";
                echo "</div>";
            }
           ?>
    </div>       
<?php     
        }
        else if($do=="Recherche"){
               
            $namefourni=$_POST['recherche'];
            $statement=$connexion->prepare("SELECT * FROM fournisseurs WHERE Nom_fourni='$namefourni'");
            $statement->execute();
            $chercher=$statement->fetchAll();
            if(!empty($chercher)){
?>
              <div class="head-d text-center">
                     <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                     <h1>Administre Fournisseurs</h1>
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
                           <span class="refr refresh-fourni">Refresh : <i class="fas fa-redo-alt"></i></span>
                       </form> 
                     </div> 
                     <table class="main-table table text-center table-bordered">
                         <tr class="table-dark">
                             <td>#ID</td>
                             <td>Nom de Fournisseur</td>
                             <td>Address</td>
                             <td>Téléphone</td>
                             <td>ICE</td>
                             <td>Control</td>
                         </tr>
                         <?php
                             foreach($chercher as $give){
                                     echo"<tr>";
                                         echo "<td>".$give['Id_fourni']."/".date("Y");
                                         echo "</td>";
                                         echo "<td>".$give['Nom_fourni']."</td>";
                                         echo "<td>".$give['Address']."</td>";
                                         echo "<td>".$give['Téléphone']."</td>";
                                         echo "<td>".$give['ICE']."</td>";
                                         echo "<td>
                                                 <a href='fournisseurs.php?do=Edit&Id_fourni=".$give['Id_fourni']."' class='btn btn-sm btn-success'><i class='icn fa fa-edit'></i>Edit</a>
                                                 <a href='fournisseurs.php?do=Delete&Id_fourni=".$give['Id_fourni']."' class='btn btn-sm btn-danger confirme'><i class='icn fas fa-minus-circle'></i>Delete</a>";  
                                         echo "</td>";
                                     echo "</tr>";
                             }
                         ?>
                     </table>
                 </div>

           <a href='fournisseurs.php?do=Add' class="btn btn-sm btn-primary"><i class="icn fa fa-plus"></i>Nouveau fournisseur</a>
           <?php
            }
            else{
                echo " <div class='head-d text-center'>
                                        <img src='".$img."Logo bis.png' class='img-fluid'>
                                        <h1>Administre Fournisseur</h1>
                        </div>  ";
                echo "<div class='container'>";
                    echo "<div class='alert alert-danger'>Pas d'un fournisseur</div>";
                    echo "<a href='fournisseurs.php?do=Add' class='btn btn-sm btn-primary'><i class='icn fa fa-plus'></i>Nouveau fournisseur</a>";
                echo "</div>";
            }
           ?>
    </div>       
<?php
        }
        else if($do=="Add"){
                  //add fournisseurs page 
?>
                <div class="head-d text-center">
                    <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                    <h1>Ajouter Nouveau Fournisseur</h1>
                </div> 
            <div class="container">
                <form action="?do=Insert" method="POST">
                            <!--for name -->
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Nom de Fournisseur</label>
                                <div class="col-sm-10 col-md-4">
                                    <input class="form-control"
                                            type="text"  
                                            name="name" 
                                            id="name" 
                                            placeholder="Nom de fournisseur" 
                                            autocomplete="off" 
                                            required="required">
                                </div>
                            </div>
                            <!--for Address -->
                            <div class="mb-3 row">
                                <label for="description" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10  col-md-4">
                                    <input 
                                            type="text" 
                                            class="form-control" 
                                            name="address" 
                                            id="address" 
                                            placeholder="Address de fournisseur"
                                            autocomplete="off"
                                            required="required">
                                </div>
                            </div>
                             <!--for Telephone -->
                             <div class="mb-3 row">
                                <label for="description" class="col-sm-2 col-form-label">Telephone</label>
                                <div class="col-sm-10  col-md-4">
                                    <input 
                                            type="text"
                                            class="form-control" 
                                            name="telephone" 
                                            id="telephone" 
                                            placeholder="Telephone de fournisseur"
                                            autocomplete="off"
                                            required="required">
                                </div>
                            </div>
                             <!--for ICE -->
                             <div class="mb-3 row">
                                <label for="description" class="col-sm-2 col-form-label">ICE</label>
                                <div class="col-sm-10  col-md-4">
                                    <input 
                                            type="text"
                                            class="form-control" 
                                            name="ice" 
                                            id="ice" 
                                            autocomplete="off"
                                            placeholder="ICE de fournisseur"
                                            required="required">
                                </div>
                            </div>
                            <!--for validation -->
                            <div class="mb-3 row"> 
                                <div class="col-sm-10 offset-sm-2">
                                    <button class="btn btn-primary" type="submit">Ajouter Fournisseur</button>
                                </div>
                            </div>     
                </form>
            </div>
<?php
        }
        else if($do=="Insert"){
               // insert data in database
                  
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                    
                            echo " <div class='head-d text-center'>
                                        <img src='".$img."Logo bis.png' class='img-fluid'>
                                        <h1>Inserer Fournisseur</h1>
                                    </div>  ";
                            echo "<div class='container'>";   
                        //get variable from here by mehtod post

                        $n          =$_POST['name'];
                        $address    =$_POST['address'];
                        $tele       =$_POST['telephone'];
                        $ice        =$_POST['ice'];
                
                        //validation required

                       
            

                            //insert into in database
                            
                                $statement=$connexion->prepare(
                                                                "INSERT INTO fournisseurs(Nom_fourni,Address,   Téléphone,ICE)
                                                                VALUES('$n','$address','$tele','$ice');
                                                                SET @Id_fourni := 0;
                                                                UPDATE fournisseurs SET Id_fourni = @Id_fourni := (@Id_fourni+1);
                                                                ALTER TABLE fournisseurs AUTO_INCREMENT = 1;"
                                                                );
                                $statement->execute(array($n,$address,$tele,$ice));
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
                  //check method get if categoryid is number and integer
                  $fournisid=(isset($_GET['Id_fourni']) && is_numeric($_GET['Id_fourni'])) ? intval($_GET['Id_fourni']) : "false";

                  // select the all data from user 
                       $statement=$connexion->prepare("SELECT * 
                                                       FROM fournisseurs 
                                                       WHERE Id_fourni=?");  
                  // execute query
                       $statement->execute(array($fournisid));
                  // fetch data
                       $row=$statement->fetch();
                  // row data      
                           $compteur=$statement->rowCount();
                 // check if there is ID or not            
                 if($compteur>0){
?>
                    <div class="head-d text-center">
                        <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                        <h1>Editer Fournisseur</h1>
                    </div> 
                <div class="container">
                    <form action="?do=Update" method="POST">
                                <input type="hidden" name="fournisid" value="<?php echo $fournisid ?>">
                                <!--for name -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Nom de Fournisseur</label>
                                    <div class="col-sm-10 col-md-4">
                                        <input class="form-control"
                                                type="text"  
                                                name="name" 
                                                id="name" 
                                                placeholder="Nom de fournisseur" 
                                                autocomplete="off"
                                                required="required"
                                                value="<?php echo $row['Nom_fourni'] ?>">
                                    </div>
                                </div>
                                <!--for Address -->
                                <div class="mb-3 row">
                                    <label for="description" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10  col-md-4">
                                        <input 
                                                type="text" 
                                                class="form-control" 
                                                name="address" 
                                                id="address" 
                                                placeholder="Address de fournisseur"
                                                autocomplete="off"
                                                required="required"
                                                value="<?php echo $row['Address'] ?>">
                                    </div>
                                </div>
                                 <!--for Telephone -->
                                 <div class="mb-3 row">
                                    <label for="description" class="col-sm-2 col-form-label">Telephone</label>
                                    <div class="col-sm-10  col-md-4">
                                        <input 
                                                type="text" 
                                                class="form-control" 
                                                name="telephone" 
                                                id="telephone" 
                                                placeholder="Telephone de fournisseur"
                                                autocomplete="off"
                                                required="required"
                                                value="<?php echo $row['Téléphone'] ?>">
                                    </div>
                                </div>
                                 <!--for ICE -->
                                 <div class="mb-3 row">
                                    <label for="description" class="col-sm-2 col-form-label">ICE</label>
                                    <div class="col-sm-10  col-md-4">
                                        <input 
                                                type="text"
                                                class="form-control" 
                                                name="ice" 
                                                id="ice" 
                                                autocomplete="off"
                                                placeholder="ICE de fournisseur"
                                                autocomplete="off"
                                                required="required"
                                                value="<?php echo $row['ICE'] ?>">
                                    </div>
                                </div>
                                <!--for validation -->
                                <div class="mb-3 row"> 
                                    <div class="col-sm-10 offset-sm-2">
                                        <button class="btn btn-primary" type="submit">Mise à Jour</button>
                                    </div>
                                </div>     
                    </form>
                </div>
<?php       
                }
                // else not ID so no such here
                else {
                    echo "<div class='container'>";
                    echo "<div class='alert alert-danger'>Sorry! ,No Such ID here</div>";
                    
                    echo "</div>";
                }                        
        }
        else if($do=="Update"){
              
            echo " <div class='head-d text-center'>
                        <img src='".$img."Logo bis.png' class='img-fluid'>
                        <h1>Mise à Jour Fournisseur</h1>
                    </div>  ";
            echo "<div class='container'>";         

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
              
                //get variable from here by mehtod post
                $id          =$_POST['fournisid'];
                $n          =$_POST['name'];
                $address    =$_POST['address'];
                $tele       =$_POST['telephone'];
                $ice        =$_POST['ice'];

                        //update database

                $statement=$connexion->prepare("UPDATE fournisseurs
                                                SET    Nom_fourni = ?, Address = ?, Téléphone=?, ICE=?  
                                                WHERE  Id_fourni = ?");
                $statement->execute(array($n,$address,$tele,$ice,$id));
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
                        <h1>Supprimer Fournisseurs</h1>
                    </div>  ";
            echo "<div class='container'>";   
                    //check method get if id categories is number and integer
                    $id=(isset($_GET['Id_fourni']) && is_numeric($_GET['Id_fourni'])) ? intval($_GET['Id_fourni']) : "false";

                    $check=checkitems('Id_fourni','fournisseurs',$id);

                            // check if there is ID or not            
                            if($check>0){
                                    //delete in database
                                    $statement=$connexion->prepare("DELETE
                                                                    FROM fournisseurs 
                                                                    WHERE Id_fourni=$id;
                                                                    SET @Id_fourni := 0;
                                                                    UPDATE fournisseurs SET Id_fourni = @Id_fourni := (@Id_fourni+1);
                                                                    ALTER TABLE fournisseurs AUTO_INCREMENT = 1;
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

        include $tpl."footer.php";
    }
    else{
        header('Location:login.php');  
        exit();
    }
    ob_end_flush(); //output beffring end  

?>