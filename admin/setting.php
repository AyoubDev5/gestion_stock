<?php
    ob_start();  //output buffering start     
    session_start();
    if(isset($_SESSION['Email'])){
         $nonavbar_log_reg='';
             include "init.php";
  
             $do= isset($_GET['do']) ? $_GET['do']:"Manage"; 
              //start edit
 
        if($do=="Setting"){  //setting page
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
                        <h1>Change Password User</h1>
                     </div>  
                    <div class="container">
                        <form action="?do=Update" method="POST">
                            <input 
                                  type="hidden" 
                                  name="userid" 
                                  value="<?php echo $userid ?>">
                                    <!--for passwword -->
                                    <div class="mb-3 row">
                                        <label for="newpassword" class="col-sm-2 col-form-label">New Password</label>
                                        <div class="col-sm-10  col-md-4">
                                            <input 
                                                  type="password" 
                                                  class="pass form-control" 
                                                  name="newpassword"  
                                                  placeholder="New Password" 
                                                  autocomplete="new-password"
                                                  required="required">
                                            <i class="show-pass fas fa-eye"></i>      
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="newpassword" class="col-sm-2 col-form-label">Confirme Password</label>
                                        <div class="col-sm-10  col-md-4">
                                            <input 
                                                  type="password" 
                                                  class="form-control" 
                                                  name="confirmepassword" 
                                                  placeholder="Confirme Password" 
                                                  autocomplete="new-password"
                                                  required="required">
                                        </div>          
                                    </div>
                                    <!--for validation -->
                                    <div class="mb-3 row"> 
                                        <div class="col-sm-10 offset-sm-2">
                                            <button class="btn btn-primary sub" type="submit">Change the Password</button>
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
                        <h1>Changing Password User</h1>
                    </div>  ";
            echo "<div class='container'>"; 
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        
                //get variable from here by mehtod post
                $id=$_POST['userid'];


                // password trick
                $password=$_POST['newpassword'];
                $cpassword=$_POST['confirmepassword'];
                $hashedpass=sha1($password);

                if($password==$cpassword){
                         //update database

                            $statement=$connexion->prepare("UPDATE users
                                                            SET    Password = ? 
                                                            WHERE  Id= ?");
                            $statement->execute(array($hashedpass,$id));
                            $compteur=$statement->rowCount(); 
                            if($compteur>0){
                                    $msg="<div class='alert alert-success'>Changing succefull</div>";
                                    redirict_in_homeV2($msg,'back',3);
                            }
                            else {
                                $msg="<div class='alert alert-danger'>! Not Changing succefull</div>";   
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