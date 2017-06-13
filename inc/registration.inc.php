<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//Prüft ob Formular gesendet wurde
if (isset($_POST['registerVorname'])){
    $check=false;
    //setzen der Anrede
    if(isset($_POST['registergender'])&& $_POST['registergender']=="Frau"){
        $anrede="Frau";
    }else{
        $anrede= "Herr";
    }
    //Überprüfen ob beide passwörter überienstimmen
    if($_POST['registerPasswort']===$_POST['registerPasswort2']){
        $passwordHashed = password_hash((String)$_POST['registerPasswort'], PASSWORD_DEFAULT);
        $user = new User;
        $user->addAllValues('0', $anrede, secureString($_POST['registerVorname']), secureString($_POST['registerNachname']), secureString($_POST['registerAdresse']),
                $_POST['registerPLZ'], secureString($_POST['registerOrt']), secureString($_POST['registerEmail']),'0', secureString($_POST['registerBenutzername']), $passwordHashed, '0');
        $usercheck=$user->validateUser();
        //prüfen ob user valide
        if ($usercheck==true){
            $db =new Database();
            $result=$db->getallBenutzernamen();
            //var_dump($result);
            if (in_array($user->getBenutzerName(),$result)){
                //Username exists
                echo "<div class='alert alert-danger col-md-6 col-md-offset-3'> Benutzername existiert schon </div>";
                include 'registrationForm.inc.php';
                }
            else {
                //insert user in DB, return to login 
                $ID=$user->insertUser();
                //Insert Zahlungsart
                $ZA= new Zahlungsart();
                $ZA->addAllValues($ID,'0', $_POST['registerKontonummer'], $_POST['registerKreditkartennummer'], $_POST['registerAblaufdatum']);
                $ZA->insertZahlungsArt();
                Echo "<div class='alert alert-success' role='alert'>Registrierung war erfolgreich<div>";
                include 'signIn.inc.php';
                
                
            }
    
        }else{
        //invalid userInput
        echo "<div class='well'> Invalid Input </div>";
        include 'registrationForm.inc.php';
        }
    }
}else{
        include 'registrationForm.inc.php';
}

