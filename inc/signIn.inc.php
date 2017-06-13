
        <?php
        // put your code here
        
        
        if (isset($_POST['inputBenutzername'])&&isset($_POST['inputPasswort'])){
            $loginUser =new User();
            $loginUser->setBenutzerName(secureString($_POST['inputBenutzername']));
            $loginUser->setPasswort($_POST['inputPasswort']);
            
            $result=$loginUser->loginUser();
            
            if($result===true){//User valide
                
                //check for setting Cookie
                if(isset($_POST['rememberMe'])){
                    
                    setcookie("name", secureString($_POST['inputBenutzername']), time() + 7200);
                    setcookie("login", $_POST['inputPasswort'], time() + 7200); 
                    

                }
                $_SESSION['BN']=secureString($_POST['inputBenutzername']);
                header("Refresh:0");
            }else{
                echo "<div class='alert alert-danger col-md-6 col-md-offset-3'> ".$result." </div>";
                include 'signInForm.inc.php';
            }
        }else{
                include 'signInForm.inc.php';
            
        }
        
        ?>

