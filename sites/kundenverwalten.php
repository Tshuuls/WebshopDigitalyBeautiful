<?php


$db = new Database();
        $allUser = $db->getallBenutzer();
        
        if(isset($_GET['KID'])){
            if(($_GET['type'])==1){//Kunde deaktivieren
                foreach ($allUser as $UserObj){
                    if($UserObj->getUserid()==$_GET['KID']){
                        $UserObj->setActiv(1);
                        $UserObj->updateUser();
                    }
                }
            }
            if(($_GET['type'])==2){//Kunde aktivieren
                foreach ($allUser as $UserObj){
                    if($UserObj->getUserid()==$_GET['KID']){
                        $UserObj->setActiv(0);
                        $UserObj->updateUser();
                    }
                }
            }
            
            
        }
        echo "<div class='col-md-8 col-md-offset-2'>";
        echo "<h2>Kunden bearbeiten</h2>";
        echo "<br>";
        //Liste aller Kunden wird aufgerufen und User deaktiveren/aktivieren Link wird hinzugefügt.
        if(!empty($allUser)){
            echo"<table class='table striped-table'> <tr><th>Nummer</th><th>Anrede</th><th>Vorname</th><th>Nachname</th><th>Adresse</th><th>PLZ</th><th>Ort</th><th>Email</th><th>Benutzername</th><th>Aktiv</th></tr>";
            foreach ($allUser as $UserObj){
                echo "<tr>";
                echo "<td><a style='cursor:pointer' href='index.php?site=kundenverwalten&type=3&KID=".$UserObj->getBenutzerName()."'>".$UserObj->getUserid()."</a></td>";  
                echo "<td>".$UserObj->getAnrede()."</td>"; 
                echo "<td>".$UserObj->getVorname()."</td>"; 
                echo "<td>".$UserObj->getNachname()."</td>"; 
                echo "<td>".$UserObj->getAdresse()."</td>";
                echo "<td>".$UserObj->getPLZ()."</td>";
                echo "<td>".$UserObj->getOrt()."</td>";
                echo "<td>".$UserObj->getEmail()."</td>";
                echo "<td>".$UserObj->getBenutzerName()."</td>";
                if($UserObj->getAdmin()==0){
                    if($UserObj->getActiv()==0){
                        echo "<td class='actiongr'> <a class='glyphicon glyphicon-ok' href='index.php?site=kundenverwalten&type=1&KID=".$UserObj->getUserid()."'></a> </td>"; 
                    }else{
                        echo "<td class='actiongr'> <a class='glyphicon glyphicon-remove' href='index.php?site=kundenverwalten&type=2&KID=".$UserObj->getUserid()."'></a> </td>"; 

                    }
                    echo "</tr>";
                    } else{
                echo "<td></td>";  
            }
            }
            echo "</table>";
            }
        
        else {
           //Falls keine Kunden vorhanden sind.
           echo "<div class='col-md-12'>";
                echo "<div class='alert alert-danger'> Keine Kunden gefunden. </div>";
           echo "</div>";
        }
if(isset($_GET['KID'])){
            if(($_GET['type'])==3){//Bestellungen anzeigen
                
                
                include './inc/BestellungensListe.inc.php';
                
                
                
            }
            
            
        }