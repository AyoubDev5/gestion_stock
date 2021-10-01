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

         $statement=$connexion->prepare("SELECT * FROM services ORDER BY Id_service $order");
         $statement->execute();
          
         $take=$statement->fetchAll();
         if(!empty($take)){
?>
         <div class="head-d text-center">
                     <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                     <h1>Administre Services</h1>
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
                           <span class="refr refresh-service">Refresh : <i class=" fas fa-redo-alt"></i></span>
                       </form> 
                     </div> 
                     <table class="main-table table text-center table-bordered">
                         <tr class="table-dark">
                             <td>#ID</td>
                             <td>Nom de Client</td>
                             <td>Nom de Service</td>
                             <td>Numero de Somme</td>
                             <td>Control</td>
                         </tr>
                         <?php
                             foreach($take as $give){
                                     echo"<tr>";
                                         echo "<td>".$give['Id_service']."/".date("Y");
                                         echo "</td>";
                                         echo "<td>".$give['Nom_client']."</td>";
                                         echo "<td>".$give['Nom_service']."</td>";
                                         echo "<td>".$give['N_som']."</td>";
                                         echo "<td>
                                                 <a href='services.php?do=Edit&Id_service=".$give['Id_service']."' class='btn btn-sm btn-success'><i class='icn fa fa-edit'></i>Edit</a>
                                                 <a href='services.php?do=Delete&Id_service=".$give['Id_service']."' class='btn btn-sm btn-danger confirme'><i class='icn fas fa-minus-circle'></i>Delete</a>";  
                                         echo "</td>";
                                     echo "</tr>";
                             }
                         ?>
                     </table>
                 </div>

           <a href='services.php?do=Add' class="btn btn-sm btn-primary"><i class="icn fa fa-plus"></i>Nouveau service</a>
           <?php
            }
            else{
                echo " <div class='head-d text-center'>
                                        <img src='".$img."Logo bis.png' class='img-fluid'>
                                        <h1>Administre service</h1>
                        </div>  ";
                echo "<div class='container'>";
                    echo "<div class='alert alert-danger'>Pas d'un service</div>";
                    echo "<a href='services.php?do=Add' class='btn btn-sm btn-primary'><i class='icn fa fa-plus'></i>Nouveau service</a>";
                echo "</div>";
            }
           ?>
    </div>       
<?php     
        }
        if($do=="Recherche"){
            $nameservice=$_POST['recherche'];
            $statement=$connexion->prepare("SELECT * FROM services WHERE Nom_service='$nameservice'");
            $statement->execute();
            $take=$statement->fetchAll(); 
            if(!empty($take)){
?>
            <div class="head-d text-center">
                        <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                        <h1>Administre Services</h1>
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
                              <span class="refr refresh-service">Refresh : <i class=" fas fa-redo-alt"></i></span>
                          </form> 
                        </div> 
                        <table class="main-table table text-center table-bordered">
                            <tr class="table-dark">
                                <td>#ID</td>
                                <td>Nom de Client</td>
                                <td>Nom de Service</td>
                                <td>Numero de Somme</td>
                                <td>Control</td>
                            </tr>
                            <?php
                                foreach($take as $give){
                                        echo"<tr>";
                                            echo "<td>".$give['Id_service']."/".date("Y");
                                            echo "</td>";
                                            echo "<td>".$give['Nom_client']."</td>";
                                            echo "<td>".$give['Nom_service']."</td>";
                                            echo "<td>".$give['N_som']."</td>";
                                            echo "<td>
                                                    <a href='services.php?do=Edit&Id_service=".$give['Id_service']."' class='btn btn-sm btn-success'><i class='icn fa fa-edit'></i>Edit</a>
                                                    <a href='services.php?do=Delete&Id_service=".$give['Id_service']."' class='btn btn-sm btn-danger confirme'><i class='icn fas fa-minus-circle'></i>Delete</a>";  
                                            echo "</td>";
                                        echo "</tr>";
                                }
                            ?>
                        </table>
                    </div>
   
              <a href='services.php?do=Add' class="btn btn-sm btn-primary"><i class="icn fa fa-plus"></i>Nouveau service</a>
              <?php
            }
            else{
                echo " <div class='head-d text-center'>
                                        <img src='".$img."Logo bis.png' class='img-fluid'>
                                        <h1>Administre service</h1>
                        </div>  ";
                echo "<div class='container'>";
                    echo "<div class='alert alert-danger'>Pas d'un service</div>";
                    echo "<a href='services.php?do=Add' class='btn btn-sm btn-primary'><i class='icn fa fa-plus'></i>Nouveau service</a>";
                echo "</div>";
            }
           ?>
       </div>       
<?php                 
        }     
        if($do=="Add"){
                             //add services page 
?>
                    <div class="head-d text-center">
                        <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                        <h1>Ajouter Nouveau Service</h1>
                    </div> 
                    <div class="container">
                        <form action="?do=Insert" method="POST">
                                <!--for name client -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Nom de client</label>
                                    <div class="col-sm-10 col-md-4">
                                        <input class="form-control"
                                                type="text"  
                                                name="client" 
                                                id="client" 
                                                placeholder="Nom de client" 
                                                autocomplete="off" 
                                                required="required">
                                    </div>
                                </div>
                                <!--for name service -->
                                <div class="mb-3 row">
                                    <label for="description" class="col-sm-2 col-form-label">Nom de service</label>
                                    <div class="col-sm-10  col-md-4">
                                        <input 
                                                type="text" 
                                                class="form-control" 
                                                name="service" 
                                                id="service" 
                                                placeholder="Nom de service"
                                                autocomplete="off"
                                                required="required">
                                    </div>
                                </div>
                                <!--for n_som -->
                                <div class="mb-3 row">
                                    <label for="description" class="col-sm-2 col-form-label">Numero de Somme</label>
                                    <div class="col-sm-10  col-md-4">
                                        <input 
                                                type="number"
                                                class="form-control" 
                                                name="numsom" 
                                                id="numsom" 
                                                placeholder="Numero de somme"
                                                autocomplete="off">
                                    </div>
                                </div>
                                <!--for validation -->
                                <div class="mb-3 row"> 
                                    <div class="col-sm-10 offset-sm-2">
                                        <button class="btn btn-primary" type="submit">Ajouter Service</button>
                                    </div>
                                </div>     
                                </form>
                        </div>
<?php
        }       
        if($do=="Insert"){
               // insert data in database
                  
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                            
                        echo " <div class='head-d text-center'>
                                    <img src='".$img."Logo bis.png' class='img-fluid'>
                                    <h1>Inserer Service</h1>
                                </div>  ";
                echo "<div class='container'>";   
                    //get variable from here by mehtod post

                    $nc         =$_POST['client'];
                    $ns         =$_POST['service'];
                    $numsom     =$_POST['numsom'];
            


                        //insert into in database
                        if(empty($_POST['numsom'])){
                            $num_som=0;  
                            $statement=$connexion->prepare(
                                                            "INSERT INTO services(Nom_client,Nom_service,N_som)
                                                            VALUES('$nc','$ns','$num_som');
                                                            SET @Id_service := 0;
                                                            UPDATE services SET Id_service = @Id_service := (@Id_service+1);
                                                            ALTER TABLE services AUTO_INCREMENT = 1;"
                                                            );
                            $statement->execute(array($nc,$ns,$num_som));
                            $compteur=$statement->rowCount(); 
                            if($compteur>0){
                                echo "<div class='alert alert-success'>Adding succefull</div>";
                                
                            }
                            else{ 
                                echo "<div class='alert alert-danger'>! Not Adding succefull</div>";
                                
                            } 
                        }else{
                                $statement=$connexion->prepare(
                                                                "INSERT INTO services(Nom_client,Nom_service,N_som)
                                                                VALUES('$nc','$ns','$numsom');
                                                                SET @Id_service := 0;
                                                                UPDATE services SET Id_service = @Id_service := (@Id_service+1);
                                                                ALTER TABLE services AUTO_INCREMENT = 1;"
                                                                );
                                $statement->execute(array($nc,$ns,$numsom));
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
                $servicesid=(isset($_GET['Id_service']) && is_numeric($_GET['Id_service'])) ? intval($_GET['Id_service']) : "false";

                // select the all data from user 
                     $statement=$connexion->prepare("SELECT * 
                                                     FROM  services 
                                                     WHERE Id_service=?");  
                // execute query
                     $statement->execute(array($servicesid));
                // fetch data
                     $row=$statement->fetch();
                // row data      
                         $compteur=$statement->rowCount();
               // check if there is ID or not            
               if($compteur>0){
?>
                    <div class="head-d text-center">
                        <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                        <h1>Editer Service</h1>
                    </div> 
                    <div class="container">
                        <form action="?do=Update" method="POST">
                            <input type="hidden" name="serviceid" value="<?php echo $servicesid ?>">
                                <!--for name client -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Nom de client</label>
                                    <div class="col-sm-10 col-md-4">
                                        <input class="form-control"
                                                type="text"  
                                                name="client" 
                                                id="client" 
                                                placeholder="Nom de client" 
                                                autocomplete="off" 
                                                required="required"
                                                value="<?php echo $row['Nom_client'] ?>">
                                    </div>
                                </div>
                                <!--for name service -->
                                <div class="mb-3 row">
                                    <label for="description" class="col-sm-2 col-form-label">Nom de service</label>
                                    <div class="col-sm-10  col-md-4">
                                        <input 
                                                type="text" 
                                                class="form-control" 
                                                name="service" 
                                                id="service" 
                                                placeholder="Nom de service"
                                                autocomplete="off"
                                                required="required"
                                                value="<?php echo $row['Nom_service'] ?>">
                                    </div>
                                </div>
                                <!--for n_som -->
                                <div class="mb-3 row">
                                    <label for="description" class="col-sm-2 col-form-label">Numero de Somme</label>
                                    <div class="col-sm-10  col-md-4">
                                        <input 
                                                type="number"
                                                class="form-control" 
                                                name="numsom" 
                                                id="numsom" 
                                                placeholder="Numero de somme"
                                                autocomplete="off"
                                                value="<?php echo $row['N_som'] ?>">
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
        if($do=="Update"){
            echo " <div class='head-d text-center'>
                        <img src='".$img."Logo bis.png' class='img-fluid'>
                        <h1>Mise à Jour Service</h1>
                    </div>  ";
            echo "<div class='container'>";         

                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                    //get variable from here by mehtod post
                    $id         =$_POST['serviceid'];
                    $nc         =$_POST['client'];
                    $ns         =$_POST['service'];
                    $numsom     =$_POST['numsom'];

                            //update database  
                        
                        $statement=$connexion->prepare("UPDATE services
                                                        SET    Nom_client = ?, Nom_service = ?, N_som=? 
                                                        WHERE  Id_service = ?");
                        $statement->execute(array($nc,$ns,$numsom,$id));
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
                        <h1>Supprimer Service</h1>
                    </div>  ";
            echo "<div class='container'>";   
                //check method get if id categories is number and integer
                    $id=(isset($_GET['Id_service']) && is_numeric($_GET['Id_service'])) ? intval($_GET['Id_service']) : "false";

                $check=checkitems('Id_service','services',$id);

                // check if there is ID or not            
                if($check>0){
                        //delete in database
                        $statement=$connexion->prepare("DELETE
                                                        FROM services 
                                                        WHERE Id_service=$id;
                                                        SET @Id_service := 0;
                                                        UPDATE services SET Id_service = @Id_servicei := (@Id_service+1);
                                                        ALTER TABLE services AUTO_INCREMENT = 1;
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