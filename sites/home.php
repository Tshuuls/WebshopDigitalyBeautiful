
        <?php
        //Check for Cookie
        if(isset($_COOKIE['name']) && !empty(isset($_COOKIE['login']))){
            $loginUser =new User();
            $loginUser->setBenutzerName($_COOKIE['name']);
            $loginUser->setPAsswort($_COOKIE['login']);
            $result=$loginUser->loginUser();
            if ($_SESSION['status']=="visitor"){
                include 'inc/signIn.inc.php';
            }elseif($_SESSION['status']=="user"||$_SESSION['status']=="admin"){
                include 'inc/userWelcome.inc.php';
                echo "login Via Cookie";
            }
        }//no Cookie check for register
        elseif(isset($_GET['register'])&& $_GET['register']=="true"){
            include 'inc/registration.inc.php';
        }
        elseif ($_SESSION['status']=="visitor"){//not logged in
            include 'inc/signIn.inc.php';
        }elseif($_SESSION['status']=="user"||$_SESSION['status']=="admin"){//loged in
            include 'inc/userWelcome.inc.php';
        }

        ?>
   