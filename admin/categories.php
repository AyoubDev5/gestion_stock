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

            $statement=$connexion->prepare("SELECT * FROM categories ORDER BY Id_categories $order");
            $statement->execute();
             
            $take=$statement->fetchAll();
            if(!empty($take)){
?>
            <div class="head-d text-center">
                        <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                        <h1>Manage Categories</h1>
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
                              <span class="refr">Refresh : <i class="fas fa-redo-alt"></i></span>
                          </form> 
                        </div> 
                        <table class="main-table table text-center table-bordered">
                            <tr class="table-dark">
                                <td>#ID</td>
                                <td>Names Of Categories</td>
                                <td>Description</td>
                                <td>Control</td>
                            </tr>
                            <?php
                                foreach($take as $give){
                                        echo"<tr>";
                                            echo "<td>".$give['Id_categories']."/".date("Y");
                                            echo "</td>";
                                            echo "<td>".$give['Nom_categories']."</td>";
                                            echo "<td>".$give['Description']."</td>";
                                            echo "<td>
                                                    <a href='categories.php?do=Edit&Id_categories=".$give['Id_categories']."' class='btn btn-sm btn-success'><i class='icn fa fa-edit'></i>Edit</a>
                                                    <a href='categories.php?do=Delete&Id_categories=".$give['Id_categories']."' class='btn btn-sm btn-danger confirme'><i class='icn fas fa-minus-circle'></i>Delete</a>";  
                                            echo "</td>";
                                        echo "</tr>";
                                }
                            ?>
                        </table>
                    </div>

              <a href='categories.php?do=Add' class="btn btn-sm btn-primary"><i class="icn fa fa-plus"></i>New category</a>
              <?php
            }
            else{
                echo " <div class='head-d text-center'>
                                        <img src='".$img."Logo bis.png' class='img-fluid'>
                                        <h1>Administre categorie</h1>
                        </div>  ";
                echo "<div class='container'>";
                    echo "<div class='alert alert-danger'>Pas d'un categorie</div>";
                    echo "<a href='categories.php?do=Add' class='btn btn-sm btn-primary'><i class='icn fa fa-plus'></i>Nouveau categorie</a>";
                echo "</div>";
            }
           ?>
       </div>       
<?php     

        }
        else if($do=="Recherche"){

               $namecateg=$_POST['recherche'];
               $statement=$connexion->prepare("SELECT * FROM categories WHERE Nom_categories='$namecateg'");
               $statement->execute();
               $chercher=$statement->fetchAll();
               if(!empty($chercher)){
?>
               <div class="head-d text-center">
                           <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                           <h1>Administre Categories</h1>
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
                                 <span class="refr refresh-categ">Refresh : <i class=" fas fa-redo-alt"></i></span>
                             </form> 
                           </div> 
                           <table class="main-table table text-center table-bordered">
                               <tr class="table-dark">
                                   <td>#ID</td>
                                   <td>Names Of Categories</td>
                                   <td>Description</td>
                                   <td>Control</td>
                               </tr>
                               <?php
                                   foreach($chercher as $cher){
                                           echo"<tr>";
                                               echo "<td>".$cher['Id_categories']."/".date("Y");
                                               echo "</td>";
                                               echo "<td>".$cher['Nom_categories']."</td>";
                                               echo "<td>".$cher['Description']."</td>";
                                               echo "<td>
                                                       <a href='categories.php?do=Edit&Id_categories=".$cher['Id_categories']."' class='btn btn-sm btn-success'><i class='icn fa fa-edit'></i>Edit</a>
                                                       <a href='categories.php?do=Delete&Id_categories=".$cher['Id_categories']."' class='btn btn-sm btn-danger confirme'><i class='icn fas fa-minus-circle'></i>Delete</a>";  
                                               echo "</td>";
                                           echo "</tr>";
                                   }
                                  
?>
                           </table>
                       </div>
   
                 <a href='categories.php?do=Add' class="btn btn-sm btn-primary"><i class="icn fa fa-plus"></i>New category</a>
<?php
                         }
                         else{
                              echo " <div class='head-d text-center'>
                                                       <img src='".$img."Logo bis.png' class='img-fluid'>
                                                       <h1>Administre categorie</h1>
                                   </div>  ";
                              echo "<div class='container'>";
                                   echo "<div class='alert alert-danger'>Pas d'un categorie</div>";
                                   echo "<a href='categories.php?do=Add' class='btn btn-sm btn-primary'><i class='icn fa fa-plus'></i>New category</a>";
                              echo "</div>";
                         }
?>
          </div>       
<?php                    
        }
        else if($do=="Add"){
              //add categories page 
?>
                    <div class="head-d text-center">
                        <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                        <h1>Ajouter Nouveau Categorie</h1>
                    </div> 
                 <div class="container">
                      <form action="?do=Insert" method="POST">
                                <!--for name -->
                                <div class="mb-3 row">
                                     <label class="col-sm-2 col-form-label">Name</label>
                                     <div class="col-sm-10 col-md-4">
                                          <input class="form-control"
                                                  type="text"  
                                                  name="name" 
                                                  id="name" 
                                                  placeholder="Name of the categories" 
                                                  autocomplete="off" 
                                                  required="required">
                                     </div>
                                </div>
                                <!--for Description -->
                                <div class="mb-3 row">
                                     <label for="description" class="col-sm-2 col-form-label">Description</label>
                                     <div class="col-sm-10  col-md-4">
                                          <input 
                                                 type="text" 
                                                 class="form-control" 
                                                 name="description" 
                                                 id="description" 
                                                 placeholder="Description for the categories">
                                     </div>
                                </div>
                                <!--for validation -->
                                <div class="mb-3 row"> 
                                     <div class="col-sm-10 offset-sm-2">
                                          <button class="btn btn-primary" type="submit">Add Category</button>
                                     </div>
                                </div>     
                      </form>
                 </div>
<?php
        }
        else if($do=="Edit"){
                  //check method get if categoryid is number and integer
                  $categoryid=(isset($_GET['Id_categories']) && is_numeric($_GET['Id_categories'])) ? intval($_GET['Id_categories']) : "false";

                  // select the all data from user 
                       $statement=$connexion->prepare("SELECT * 
                                                       FROM categories 
                                                       WHERE Id_categories=?");  
                  // execute query
                       $statement->execute(array($categoryid));
                  // fetch data
                       $row=$statement->fetch();
                  // row data      
                           $compteur=$statement->rowCount();
                 // check if there is ID or not            
                 if($compteur>0){
?> 
                    <div class="head-d text-center">
                         <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                         <h1>Editer Categorie</h1>
                    </div> 
                    <div class="container">
                         <form action="?do=Update" method="POST">
                                   <input type="hidden" name="categid" value="<?php echo $categoryid ?>">
                                    <!--for name -->
                                <div class="mb-3 row">
                                     <label class="col-sm-2 col-form-label">Name Of Category</label>
                                     <div class="col-sm-10 col-md-4">
                                          <input class="form-control" 
                                                 type="text" 
                                                 name="name" 
                                                 id="name" 
                                                 placeholder="Name of the categories"
                                                 required="required" 
                                                 value="<?php echo $row['Nom_categories'] ?>">
                                     </div>
                                </div>
                                <!--for Description -->
                                <div class="mb-3 row">
                                     <label for="description" class="col-sm-2 col-form-label">Description</label>
                                     <div class="col-sm-10  col-md-4">
                                          <input type="text" 
                                                 class="form-control" 
                                                 name="description" 
                                                 id="description" 
                                                 placeholder="Description for the categories" 
                                                 value="<?php echo $row['Description'] ?>">
                                     </div>
                                </div>
                                   <!--for validation -->
                                   <div class="mb-3 row"> 
                                        <div class="col-sm-10 offset-sm-2">
                                             <button class="btn btn-primary sub" type="submit">Update</button>
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
        else if($do=="Insert"){
               // insert data in database
                  
               if($_SERVER['REQUEST_METHOD'] == 'POST'){
                          
                    echo " <div class='head-d text-center'>
                              <img src='".$img."Logo bis.png' class='img-fluid'>
                              <h1>Inserer Categorie</h1>
                           </div>  ";
                 echo "<div class='container'>";   
                //get variable from here by mehtod post
 
                $n          =$_POST['name'];
                $descrip    =$_POST['description'];
        
                //validation required

                $erroform=array();

                if(strlen($n) < 3) 
                          $erroform[] = "name can't be less than 3 characters";

                if(strlen($n) > 20) 
                          $erroform[] = "name can't be more than 20 characters";          

                if(empty($_POST['name']))  
                     $erroform[]="name is empty";
                 
                // give me error into array

                foreach($erroform as $error) 
                     echo "<div class='alert alert-danger'>.$error.</div>";
           
                if(empty($erroform)){

                     //insert into in database
                     
                          $statement=$connexion->prepare("INSERT INTO categories(Nom_categories,Description)
                                                         VALUES('$n','$descrip');
                                                         SET @Id_categories := 0;
                                                         UPDATE categories SET Id_categories = @Id_categories := (@Id_categories+1);
                                                         ALTER TABLE categories AUTO_INCREMENT = 1;"
                                                         );
                          $statement->execute(array($n,$descrip));
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
        else if($do=="Update"){

          echo " <div class='head-d text-center'>
                    <img src='".$img."Logo bis.png' class='img-fluid'>
                    <h1>Mise à Jour Categorie</h1>
                </div>  ";
          echo "<div class='container'>";         

          if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        
               //get variable from here by mehtod post
               $id     =$_POST['categid'];
               $name   =$_POST['name'];
               $descr  =$_POST['description'];

                      //update database

                    $statement=$connexion->prepare("UPDATE categories
                                                  SET    Nom_categories = ?, Description = ?  
                                                  WHERE  Id_categories = ?");
                    $statement->execute(array($name,$descr,$id));
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
                              <h1>Supprimer Categorie</h1>
                            </div>  ";
                    echo "<div class='container'>";   
                    //check method get if id categories is number and integer
                    $id=(isset($_GET['Id_categories']) && is_numeric($_GET['Id_categories'])) ? intval($_GET['Id_categories']) : "false";

                    $check=checkitems('Id_categories','categories',$id);
               
                    // check if there is ID or not            
               if($check>0){
                    //delete in database
                    $statement=$connexion->prepare("   DELETE
                                                       FROM categories 
                                                       WHERE Id_categories=$id;
                                                       SET @Id_categories := 0;
                                                       UPDATE categories SET Id_categories = @Id_categories := (@Id_categories+1);
                                                       ALTER TABLE categories AUTO_INCREMENT = 1;
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