<?php
    ob_start();  //output buffering start 
      session_start();
      $nonavbar=''; // page don't have navbar
      if(isset($_SESSION['Email'])) header('Location:dashboard.php');
    
    
            include "init.php";
     //Check if users coming from http post request

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
         $email=$_POST['email'];
         $password=$_POST['password'];
         $hashedpass=sha1($password);
         

             //Check if user exit in DATABASE

         $statement=$connexion->prepare("SELECT Id,Email, Password 
                                         FROM users 
                                         WHERE Email=? AND Password=?");  
         $statement->execute(array($email, $hashedpass));
         $row=$statement->fetch();
         $compteur=$statement->rowCount();
        
              // compteur for database contain record about username 
          if($compteur>0){ 
                    $_SESSION['Email']=$email; //register session name
                    $_SESSION['Id']=$row['Id'];  //register session id
               header('Location: dashboard.php'); //redirect into dashboard
                exit();
            
          }
          else{
              echo "<div class='pas-em container'>";
              echo "<div class='text-center alert alert-danger'>Email or Password is incorrect</div>";
              echo "</div>";
          }
    }
?>
                <div class="head-d text-center">
                    <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
                </div>   
        <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <h1 class="text-center mb-0 h1">Login</h1>
            <input class="form-control" type="email" name="email" placeholder="Email" autocomplete="off">
            <input class="form-control" type="password" name="password" placeholder="Password" autocomplete="new-password">
            <input class="btn btn-md btn-primary" type="submit" name="submit" value="Login">
        </form>
    

<?php
    include $tpl."footer.php";


    ob_end_flush(); //output beffring end          
?>