<?php

function listvoucher(){
        $db = new Database();
        //alle Gutscheine aus der Datenbank laden.
        $allVoucher = $db->getallvoucher();
        //Variablen initialisieren, aktuellen Zeitpunkt holen
        $rowcolor = "";
        $rowcolorend = "</font>";
        $now = new DateTime();
        //Tabelle mit Gutscheinen wird geschrieben.
        echo "<div class='col-md-6 col-md-offset-2'>";
        echo "<h2>Gutscheine</h2>";
        echo "<br>";
        echo "<div class='col-sm-offset-0 col-sm-10'><form class='form-horizontal' method='POST' action='index.php?site=gutscheineverwalten&type=1'><button type='submit' class='btn btn-primary'>Neuen Gutschein hinzufügen</button></form><br></div>";
        if(!empty($allVoucher)){
            echo"<table class='table striped-table'> <tr><th>Nummer</th><th>Wert</th><th>Gültigkeit</th><th>Status</th></tr>";
            foreach ($allVoucher as $vouchObj){
                
                 $date = new DateTime($vouchObj->getGueltigkeit());
                 //Es wir überprüft ob der Gutschein schon eingelößt worden ist.
                 if($vouchObj->getEingeloest() == 1) {
                                                        
                                                        $status = "eingelöst";
                                                        $rowcolor ='<font color ="grey">';
                                                    }
                 else {$status = "aktiv";}
                 //Gültigkeitsdatum überprüfen.
                 if($date < $now){
                                                        $status = "abgelaufen";
                                                        $rowcolor ='<font color="red">';
                                                    }
                  
                echo "<tr>";
                echo "<td>".$vouchObj->getGutscheinID()."</td>";  
                echo "<td>".$vouchObj->getWert()."</td>"; 
                echo "<td>".$vouchObj->getGueltigkeit()."</td>";
                echo "<td>".$rowcolor.$status."</td>";
                echo $rowcolorend;
                echo "</tr>";
                }  
            echo "</table>";
            }
        
        else {
            //Falls keine Gutscheine gefunden werden.
           echo "<div class='col-md-12'>";
                echo "<div class='alert alert-danger'> Keine Gutscheine gefunden. </div>";
           echo "</div>";
        }
}