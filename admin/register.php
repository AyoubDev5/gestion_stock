<?php
      session_start();
      $nonavbar=''; // page don't have navbar
      if(isset($_SESSION['Email'])) header('Location:index.php');
            include "init.php";
     //Check if users coming from http post request

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
         $name=$_POST['name'];
         $email=$_POST['mail'];
         $password=$_POST['password'];
         $cpassword=$_POST['confpassword'];
         $hashedpass=sha1($password);
         
          if($password==$cpassword){
             //Check if user exit in DATABASE
                $statement=$connexion->prepare("SELECT Id,Name,Email,Password 
                                                FROM users 
                                                WHERE Name=? AND Email=? AND Password=?");  
                $statement->execute(array($name,$email,$hashedpass));
                $row=$statement->fetch();
                $compteur=$statement->rowCount();
        
                    // compteur for database contain record about username 
               if($compteur==0){ 
                            $statement=$connexion->prepare("INSERT INTO users (Name, Email, Password)
                                                            VALUES ('$name', '$email', '$hashedpass')"); 
                            $statement->execute(array($name,$email,$hashedpass));
                            header('Location: login.php'); //redirect into dashboard
                            exit();
               }
               else{
                    header('Location: index.php'); //redirect into login
                    exit();
               }
          }
    }
?>
               <div class="head-d text-center">
                    <img src="<?php echo $img."Logo bis.png"?>" class="img-fluid">
               </div>   
                <header class="sgn text-center">
                    <h1>Sign-In</h1>
                </header>
                <div class="container">
                      <form action="" method="POST">
                                <!--for username -->
                                <div class="mb-3 row">
                                     <label class="col-sm-2 col-form-label">Name</label>
                                     <div class="col-sm-10 col-md-4">
                                          <input 
                                              class="form-control" 
                                              type="text" 
                                              name="name" 
                                              id="name" 
                                              placeholder="Name" 
                                              required="required"
                                             >
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
                                             required="required"
                                             >
                                     </div>
                                </div>
                                <!--for passwword -->
                                <div class="mb-3 row">
                                     <label for="newpassword" class="col-sm-2 col-form-label">New Password</label>
                                     <div class="col-sm-10  col-md-4">
                                          <input 
                                                type="password" 
                                                class="pass form-control" 
                                                name="password" 
                                                id="password" 
                                                placeholder="Password" 
                                                autocomplete="new-password" 
                                                required="required">
                                          <i class="show-pass fas fa-eye"></i>
                                     </div>
                                </div>
                                <!--for confirme passwword -->
                                <div class="mb-3 row">
                                     <label for="confpassword" class="col-sm-2 col-form-label">Confirme Password</label>
                                     <div class="col-sm-10  col-md-4">
                                          <input 
                                              type="password" 
                                              class="pass form-control" 
                                              name="confpassword" 
                                              id="password" 
                                              placeholder="Confirme Password" 
                                              autocomplete="new-password" 
                                              required="required">
                                     </div>
                                </div>
                                <!--for validation -->
                                <div class="mb-3 row"> 
                                     <div class="col-sm-10 offset-sm-2">
                                          <button class="btn btn-success" type="submit">Sign-in</button>
                                     </div>
                                </div>     
                      </form>
                 </div>               
<?php
    include $tpl."footer.php";
?>                   