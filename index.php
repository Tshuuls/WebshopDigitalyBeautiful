<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="css/Style.css" rel="stylesheet" type="text/css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="ajax/myJS.js"></script>
        <?php 
        //Include aller Klassen
        include 'model/Database.class.php';
        include 'model/User.class.php';
        include 'model/Zahlungsart.class.php';
        include 'model/Gutschein.class.php';
        include 'model/Bestellung.class.php';
        include 'model/Position.class.php';
        include 'model/Product.class.php';
        include 'model/Kategory.class.php';
        include 'model/BestellungPositionen.class.php';
        include 'res/security.php'
        ?>
        
    </head>
    <body>
    <?php 

    session_start();
    //bei erstem laden auf Produkte verweisen und Warenkorb anlegen
       
    if(!isset($_SESSION['site'])){
        $_SESSION['site']= "produkte";
        $_SESSION['warenkorb']= array();
        
    }
    if(!isset($_SESSION['status'])){
        $_SESSION['status']= "visitor";
    }elseif(isset($_SESSION['status'])&& isset ($_GET['site'])&& $_GET['site']=="Logout"){
        
                
        $_SESSION['user']= null;
        $_SESSION['status']= "visitor";
        
        setcookie("name", "", time() - 7200);
        setcookie("login", "", time() - 7200); 
       
    }
    
    
    $_SESSION['active']= "home";
    $_SESSION['href']= "sites/home.php";
    
    
    
    //include NavBar
    if(isset($_GET['site'])&&$_GET['site']!="rechnung"){
        
    include 'sites/navbar.php';
    
    ?>
 
        <div class="container" style="top:55px; position: relative">
<?php

        
        echo "<script>updateWarenkorbCount(".count($_SESSION['warenkorb']).")</script>";
        include $_SESSION['href'];
    }else{
        include 'sites/rechnung.php';
    }
        ?>

    </div> <!-- /container -->
    <script src="ajax/myJS.js"></script>
    <!--<script>newWarenkorb()</script>-->
        
    </body>
</html>
