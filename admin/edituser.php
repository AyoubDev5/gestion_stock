<?php
    ob_start();  //output buffering start     
    session_start();

    if(isset($_SESSION['Email'])){
        
        $nonavbar_log_reg='';

            include "init.php";
 
            $do= isset($_GET['do']) ? $_GET['do']:"Manage"; 
             //start edit

        if($do=="Edit"){  //edit page
                     
                //check method get if userid is number and integer
             $userid=(isset($_GET['Id']) && is_numeric($_GET['Id'])) ? intval($_GET['Id']) : "false";

                 // select the all data from user 
                      $statement=$connexion->prepare("SELECT * 
                                                      FROM users 
                                                      WHERE Id=?");  
                 // execute query
                      $statement->execute(array($userid));
                 // fetch data
                      $row=$statement->fetch();
                 // row data      
                      $compteur=$statement->rowCount();
          // check if there is ID or not            
            if($compteur>0){
?>
                    <div class="head-d text-center">
                        <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                        <h1>Edit User</h1>
                     </div>  
                    <div class="container">
                        <form action="?do=Update" method="POST">
                            <input 
                                  type="hidden" 
                                  name="userid" 
                                  value="<?php echo $userid ?>">
                                    <!--for username -->
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10 col-md-4">
                                            <input 
                                                  class="form-control" 
                                                  type="text" 
                                                  name="username" 
                                                  id="name" 
                                                  placeholder="Username" 
                                                  value="<?php echo $row['Name'] ?>" 
                                                  autocomplete="off" required="required">
                                        </div>
                                    </div>
                                     <!--for email -->
                                     <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10  col-md-4">
                                            <input 
                                                  class="form-control" 
                                                  type="email" 
                                                  name="mail" 
                                                  id="e-mail" 
                                                  placeholder="Email" 
                                                  value="<?php echo $row['Email'] ?>" 
                                                  required="required">
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
                        $msg="<div class='alert alert-danger'>Sorry! ,No Such ID here</div>";
                        redirict_in_homeV2($msg,'back',3);
                        echo "</div>";
                    }
            }
            else if($do=="Update"){  //Update page in data base

                echo " <div class='head-d text-center'>
                            <img src='".$img."Logo bis.png' class='img-fluid'>
                            <h1>Update User</h1>
                        </div>  ";
                echo "<div class='container'>"; 
                        
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        
                    //get variable from here by mehtod post
                    $id=$_POST['userid'];
                    $usern=$_POST['username'];
                    $email=$_POST['mail'];

                    //validation required

                    $erroform=array();

                        if(strlen($usern) < 3) 
                            $erroform[] = "name can't be less than 2 characters";

                        if(empty($_POST['username']))  
                            $erroform[]="name is empty";

                        if(empty($_POST['mail']))  
                            $erroform[]="mail is empty";
                        
                        // give me error into array

                        foreach($erroform as $error) 
                            echo "<div class='alert alert-danger'>.$error.</div>";
                    
                    if(empty($erroform)){

                            //update database

                        $statement=$connexion->prepare("UPDATE users
                                                        SET    Name = ?, Email = ?  
                                                        WHERE  Id= ?");
                        $statement->execute(array($usern,$email,$id));
                        $compteur=$statement->rowCount(); 
                        if($compteur>0){
                                $msg="<div class='alert alert-success'>Update succefull</div>";
                                redirict_in_homeV2($msg,'back',3);
                        }
                        else {
                                $msg="<div class='alert alert-danger'>! Not Update succefull</div>";   
                                redirict_in_homeV2($msg,'back',3);
                        }            
                    }
                    
                }
                else{
                    $msg="<div class='alert alert-danger'>Sorry, You can't browse this page directly</div>";   
                    redirict_in_homeV2($msg,'back',3); 
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