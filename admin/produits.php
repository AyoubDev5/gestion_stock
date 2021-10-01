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
                                                 "SELECT produits.* , categories.Nom_categories ,fournisseurs.  Nom_fourni FROM produits 
                                                 INNER JOIN categories ON categories.Id_categories=produits.Id_categories
                                                 INNER JOIN fournisseurs ON fournisseurs.Id_fourni=produits.Id_fourni 
                                                 ORDER BY Id_produit $order
                                                 ");
                  $statement->execute();
                   
                  $take=$statement->fetchAll();
                  if(!empty($take)){
?>
 <div class="head-d text-center">
                     <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                     <h1>Administre Produits</h1>
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
                           <span class="refr refresh-produit">Refresh : <i class=" fas fa-redo-alt"></i></span>
                       </form> 
                     </div> 
                     <table class="main-table table text-center table-bordered">
                         <tr class="table-dark">
                             <td>#ID</td>
                             <td>Nom de Produit</td>
                             <td>Quantité</td>
                             <td>Nom de Categorie</td>
                             <td>Nom de Fournisseur</td>
                             <td>Control</td>
                         </tr>
                         <?php
                             foreach($take as $give){
                                     echo"<tr>";
                                         echo "<td>".$give['Id_produit']."/".date("Y")."</td>";
                                         echo "<td>".$give['Nom_produit']."</td>";
                                         echo "<td>".$give['Quantité']."</td>";
                                         echo "<td>".$give['Nom_categories']."</td>";
                                         echo "<td>".$give['Nom_fourni']."</td>";
                                         echo "<td>
                                                 <a href='produits.php?do=Edit&Id_produit=".$give['Id_produit']."' class='btn btn-sm btn-success'><i class='icn fa fa-edit'></i>Edit</a>
                                                 <a href='produits.php?do=Delete&Id_produit=".$give['Id_produit']."' class='btn btn-sm btn-danger confirme'><i class='icn fas fa-minus-circle'></i>Delete</a>";  
                                         echo "</td>";
                                     echo "</tr>";
                             }
                         ?>
                     </table>
                 </div>

           <a href='produits.php?do=Add' class="btn btn-sm btn-primary"><i class="icn fa fa-plus"></i>Nouveau produit</a>
           <?php
            }
            else{
                echo " <div class='head-d text-center'>
                                        <img src='".$img."Logo bis.png' class='img-fluid'>
                                        <h1>Administre produit</h1>
                        </div>  ";
                echo "<div class='container'>";
                    echo "<div class='alert alert-danger'>Pas d'un produit</div>";
                    echo "<a href='produits.php?do=Add' class='btn btn-sm btn-primary'><i class='icn fa fa-plus'></i>Nouveau produit</a>";
                echo "</div>";
            }
           ?>
    </div>       
<?php                  
              }
              if($do=="Recherche"){
                     $nameproduit=$_POST['recherche'];
                     $statement=$connexion->prepare(
                                                    "SELECT produits.*,
                                                            categories.Nom_categories,
                                                            fournisseurs.Nom_fourni  
                                                    FROM produits 
                                                    INNER JOIN categories ON categories.Id_categories=produits. Id_categories
                                                    INNER JOIN fournisseurs ON fournisseurs.Id_fourni=produits.Id_fourni
                                                    WHERE Nom_produit='$nameproduit'; 
                                                    ");
                     $statement->execute();
                     $take=$statement->fetchAll(); 
                     if(!empty($take)){

?>
                     <div class="head-d text-center">
                                         <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                                         <h1>Administre Produits</h1>
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
                                               <span class="refr refresh-produit">Refresh : <i class=" fas fa-redo-alt"></i></span>
                                           </form> 
                                         </div> 
                                         <table class="main-table table text-center table-bordered">
                                             <tr class="table-dark">
                                                 <td>#ID</td>
                                                 <td>Nom de Produit</td>
                                                 <td>Quantité</td>
                                                 <td>Nom de Categorie</td>
                                                 <td>Nom de Fournisseur</td>
                                                 <td>Control</td>
                                             </tr>
                                             <?php
                                                 foreach($take as $give){
                                                         echo"<tr>";
                                                             echo "<td>".$give['Id_produit']."/".date("Y")."</td>";
                                                             echo "<td>".$give['Nom_produit']."</td>";
                                                             echo "<td>".$give['Quantité']."</td>";
                                                             echo "<td>".$give['Nom_categories']."</td>";
                                                             echo "<td>".$give['Nom_fourni']."</td>";
                                                             echo "<td>
                                                                     <a href='produits.php?do=Edit&Id_produit=".$give['Id_produit']."' class='btn btn-sm btn-success'><i class='icn fa fa-edit'></i>Edit</a>
                                                                     <a href='produits.php?do=Delete&Id_produit=".$give['Id_produit']."' class='btn btn-sm btn-danger confirme'><i class='icn fas fa-minus-circle'></i>Delete</a>";  
                                                             echo "</td>";
                                                         echo "</tr>";
                                                 }
                                             ?>
                                         </table>
                                     </div>
                    
                               <a href='produits.php?do=Add' class="btn btn-sm btn-primary"><i class="icn fa fa-plus"></i>Nouveau produit</a>
            <?php
                                }
                                else{
                                    echo " <div class='head-d text-center'>
                                                            <img src='".$img."Logo bis.png' class='img-fluid'>
                                                            <h1>Administre produit</h1>
                                            </div>  ";
                                    echo "<div class='container'>";
                                        echo "<div class='alert alert-danger'>Pas d'un produit</div>";
                                        echo "<a href='produits.php?do=Add' class='btn btn-sm btn-primary'><i class='icn fa fa-plus'></i>Nouveau produit</a>";
                                    echo "</div>";
                                }
           ?>
                        </div>       
<?php                  
              }  
              if($do=="Add"){
                            //add produit page 
?>
                            <div class="head-d text-center">
                                <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                                <h1>Ajouter Nouveau Produit</h1>
                            </div> 
                            <div class="container">
                                <form action="?do=Insert" method="POST">
                                        <!--for name produit -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Nom de produit</label>
                                            <div class="col-sm-10 col-md-4">
                                                <input class="form-control"
                                                        type="text"  
                                                        name="produit" 
                                                        id="produit" 
                                                        placeholder="Nom de produit" 
                                                        autocomplete="off" 
                                                        required="required">
                                            </div>
                                        </div>
                                        <!--for name Quantité -->
                                        <div class="mb-3 row">
                                            <label for="description" class="col-sm-2 col-form-label">Quantité</label>
                                            <div class="col-sm-10  col-md-4">
                                                <input 
                                                        type="number" 
                                                        class="form-control" 
                                                        name="quantite" 
                                                        id="quantite" 
                                                        placeholder="Nom de quantite"
                                                        autocomplete="off">
                                            </div>
                                        </div>
                                        <!--for name categories-->
                                        <div class="mb-3 row">
                                            <label for="categ" class="col-sm-2 col-form-label">Nom de Categorie</label>
                                            <div class="col-sm-10  col-md-4">
                                            <select name="category">
                                                 <option value="0"></option>
                                                 <?php
                                                        $statement=$connexion->prepare("SELECT * FROM categories");
                                                        $statement->execute();
                                                        $categs=$statement->fetchAll();
                                                        foreach($categs as $categ){
                                                               echo "<option value='".$categ['Id_categories']."'>"
                                                                      .$categ['Nom_categories'];
                                                               echo "</option>";
                                                        }
                                                        ?>
                                                 </select>
                                            </div>
                                        </div>
                                         <!--for name fournisserus-->
                                         <div class="mb-3 row">
                                            <label for="description" class="col-sm-2 col-form-label">Nom de Fournisseur</label>
                                            <div class="col-sm-10  col-md-4">
                                            <select name="fournis">
                                                 <option value="0"></option>
                                                 <?php
                                                        $statement=$connexion->prepare("SELECT * FROM fournisseurs");
                                                        $statement->execute();
                                                        $fournis=$statement->fetchAll();
                                                        foreach($fournis as $fourni){
                                                               echo "<option value='".$fourni['Id_fourni']."'>"
                                                                      .$fourni['Nom_fourni'];
                                                               echo "</option>";
                                                        }
                                                        ?>
                                                 </select>
                                            </div>
                                        </div>
                                        <!--for validation -->
                                        <div class="mb-3 row"> 
                                            <div class="col-sm-10 offset-sm-2">
                                                <button class="btn btn-primary" type="submit">Ajouter Produit</button>
                                            </div>
                                        </div>     
                                   </form>
                                </div>
<?php
              }  
              if($do=="Insert"){
                     if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                            
                            echo " <div class='head-d text-center'>
                                        <img src='".$img."Logo bis.png' class='img-fluid'>
                                        <h1>Inserer Produit</h1>
                                    </div>  ";
                    echo "<div class='container'>";   
                        //get variable from here by mehtod post
    
                        $np         =$_POST['produit'];
                        $qte        =$_POST['quantite'];
                        $ncateg     =$_POST['category'];
                        $nfourni    =$_POST['fournis'];
                   
                
                        
    
                            //insert into in database
                            if(empty($_POST['quantite'])){
                                   $qte0='';  
                                $statement=$connexion->prepare(
                                                                "INSERT INTO produits(Nom_produit,Quantité,Id_categories,Id_fourni)
                                                                VALUES('$np','$qte0','$ncateg','$nfourni');
                                                                SET @Id_produit := 0;
                                                                UPDATE produits SET Id_produit = @Id_produit := (@Id_produit+1);
                                                                ALTER TABLE produits AUTO_INCREMENT = 1;"
                                                                );
                                $statement->execute(array($np,$qte0,$ncateg,$nfourni));
                                $compteur=$statement->rowCount(); 
                                if($compteur>0){
                                    echo "<div class='alert alert-success'>Adding succefull</div>";
        
                                }
                                else{ 
                                    echo "<div class='alert alert-danger'>! Not Adding succefull</div>";
        
                                } 
                            }else{
                                   $statement=$connexion->prepare(
                                                                      "INSERT INTO produits(Nom_produit,Quantité,Id_categories,Id_fourni)
                                                                      VALUES('$np','$qte','$ncateg','$nfourni');
                                                                      SET @Id_produit := 0;
                                                                      UPDATE produits SET Id_produit = @Id_produit := (@Id_produit+1);
                                                                      ALTER TABLE produits AUTO_INCREMENT = 1;"
                                                                      );
                                          $statement->execute(array($np,$qte,$ncateg,$nfourni));
                                          $compteur=$statement->rowCount(); 
                                          if($compteur>0){
                                                 echo "<div class='alert alert-success'>Adding succefull</div>";
                        
                                          }
                                          else{ 
                                                 echo "<div class='alert alert-danger'>! Not Adding succefull</div>";
                        
                                          } 
                            }              
                        
                
                    }
                    else{
                        echo "<div class='container'>";
                        echo "<div class='alert alert-danger'>Sorry! ,You can't directly in this page</div>";
                        echo "</div>";
                    } 
    
                    echo "</div>";  
              }  
              if($do=="Edit"){
                            //check method get if id is number and integer
                            $produitid=(isset($_GET['Id_produit']) && is_numeric($_GET['Id_produit'])) ? intval($_GET['Id_produit']) : "false";

                            // select the all data from user 
                            $statement=$connexion->prepare("SELECT * 
                                                               FROM  produits 
                                                               WHERE Id_produit=?");  
                            // execute query
                            $statement->execute(array($produitid));
                            // fetch data
                            $row=$statement->fetch();
                            // row data      
                                   $compteur=$statement->rowCount();
                            // check if there is ID or not            
                            if($compteur>0){  
?>

                            <div class="head-d text-center">
                                <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                                <h1>Editer Produit</h1>
                            </div> 
                            <div class="container">
                                <form action="?do=Update" method="POST">
                                <input type="hidden" name="produitid" value="<?php echo $produitid ?>">
                                        <!--for name produit -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Nom de produit</label>
                                            <div class="col-sm-10 col-md-4">
                                                <input class="form-control"
                                                        type="text"  
                                                        name="produit" 
                                                        id="produit" 
                                                        placeholder="Nom de produit" 
                                                        autocomplete="off" 
                                                        required="required"
                                                        value="<?php echo $row['Nom_produit'] ?>">
                                            </div>
                                        </div>
                                        <!--for name Quantité -->
                                        <div class="mb-3 row">
                                            <label for="description" class="col-sm-2 col-form-label">Quantité</label>
                                            <div class="col-sm-10  col-md-4">
                                                <input 
                                                        type="number" 
                                                        class="form-control" 
                                                        name="quantite" 
                                                        id="quantite" 
                                                        placeholder="Nom de quantite"
                                                        autocomplete="off"
                                                        value="<?php echo $row['Quantité'] ?>">
                                            </div>
                                        </div>
                                        <!--for name categories-->
                                        <div class="mb-3 row">
                                            <label for="categ" class="col-sm-2 col-form-label">Nom de Categorie</label>
                                            <div class="col-sm-10  col-md-4">
                                            <select name="category">
                                                 <option value="0"></option>
                                                 <?php
                                                        $statement=$connexion->prepare("SELECT * FROM categories");
                                                        $statement->execute();
                                                        $categs=$statement->fetchAll();
                                                        foreach($categs as $categ){
                                                               echo "<option value='".$categ['Id_categories']."'";
                                                                       if($row['Id_categories']==$categ    ['Id_categories'])
                                                                           echo "selected";
                                                               echo ">".$categ['Nom_categories']."</option>";
                                                        }
                                                        ?>
                                                 </select>
                                            </div>
                                        </div>
                                         <!--for name fournisserus-->
                                         <div class="mb-3 row">
                                            <label for="description" class="col-sm-2 col-form-label">Nom de Fournisseur</label>
                                            <div class="col-sm-10  col-md-4">
                                            <select name="fournis">
                                                 <option value="0"></option>
                                                 <?php
                                                        $statement=$connexion->prepare("SELECT * FROM fournisseurs");
                                                        $statement->execute();
                                                        $fournis=$statement->fetchAll();
                                                        foreach($fournis as $fourni){
                                                               echo "<option value='".$fourni['Id_fourni']."'";
                                                                      if($row['Id_fourni']==$fourni['Id_fourni'])
                                                                             echo "selected";
                                                               echo ">".$fourni['Nom_fourni']."</option>";
                                                        }
                                                        ?>
                                                 </select>
                                            </div>
                                        </div>
                                        <!--for validation -->
                                        <div class="mb-3 row"> 
                                            <div class="col-sm-10 offset-sm-2">
                                                <button class="btn btn-primary" type="submit">Mise à Jour Produit</button>
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
              if($do=="Update"){
                             echo " <div class='head-d text-center'>
                                          <img src='".$img."Logo bis.png' class='img-fluid'>
                                          <h1>Mise à Jour Produit</h1>
                                   </div>  ";
                     echo "<div class='container'>";         

                            if($_SERVER['REQUEST_METHOD'] == 'POST'){
             
                            //get variable from here by mehtod post
                            $id         =$_POST['produitid'];
                            $np         =$_POST['produit'];
                            $qte        =$_POST['quantite'];
                            $ncateg     =$_POST['category'];
                            $nfourni    =$_POST['fournis'];

                                   //update database  
                     
                                    $statement=$connexion->prepare("UPDATE produits
                                                                   SET Nom_produit = ?, Quantité = ?, Id_categories =? , Id_fourni=?
                                                                    WHERE  Id_produit = ?");
                                   $statement->execute(array($np,$qte,$ncateg,$nfourni,$id));
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
              if($do=="Delete"){
                     echo " <div class='head-d text-center'>
                                   <img src='".$img."Logo bis.png' class='img-fluid'>
                                   <h1>Supprimer Produit</h1>
                            </div>  ";
               echo "<div class='container'>";   
             //check method get if id categories is number and integer
                 $id=(isset($_GET['Id_produit']) && is_numeric($_GET['Id_produit'])) ? intval($_GET['Id_produit']) : "false";

                     $check=checkitems('Id_produit','produits',$id);

                     // check if there is ID or not            
                     if($check>0){
                                   //delete in database
                                   $statement=$connexion->prepare("DELETE
                                                               FROM produits 
                                                               WHERE Id_produit=$id;
                                                               SET @Id_produit := 0;
                                                               UPDATE produits SET Id_produit = @Id_produit := (@Id_produit+1);
                                                               ALTER TABLE produits AUTO_INCREMENT = 1;
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