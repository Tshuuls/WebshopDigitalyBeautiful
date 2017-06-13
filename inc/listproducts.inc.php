<?php

function listproducts(){
            $db = new Database();
            $allProd = $db->getallproducts();
            echo "<div class='col-md-6 col-md-offset-2'>";
            echo "<h2>Produkte bearbeiten</h2>";
            echo "<br>";
            echo "<div class='col-sm-offset-0 col-sm-10'><form class='form-horizontal' method='POST' action='index.php?site=produktebearbeiten&type=1'><button type='submit' class='btn btn-primary'>Neues Produkt hinzufügen</button></form><br></div>";
            if(!empty($allProd)){
                echo"<table class='table striped-table'> <tr><th>Nummer</th><th>Name</th><th>Beschreibung</th><th>Kategorie</th><th>Preis</th><th>Bewertung</th><th>Bild</th><th>Aktion</th></tr>";
                foreach ($allProd as $prodObj){
                    echo "<tr>";
                    echo "<td>".$prodObj->getProduktid()."</td>";  
                    echo "<td>".$prodObj->getName()."</td>"; 
                    echo "<td>".$prodObj->getBeschreibung()."</td>";
                    echo "<td>".$prodObj->getKategoriebeschreibung()."</td>";
                    echo "<td>".$prodObj->getPreis()."</td>";
                    echo "<td>".$prodObj->getBewertung()."</td>";
                    echo "<td><img class='img2' src='pictures/".$prodObj->getFoto().".jpg'></td>";
                    echo "<td class='actiongr'> <a class='glyphicon glyphicon-pencil' href='index.php?site=produktebearbeiten&type=2&PID=".$prodObj->getProduktid()."'></a> <a class='glyphicon glyphicon-remove' href='index.php?site=produktebearbeiten&type=3&PID=".$prodObj->getProduktid()."'></a></td>"; 
                    echo "</tr>";
                    }  
                echo "</table>";
                }
        
            else {
               echo "<div class='col-md-12'>";
                    echo "<div class='alert alert-danger'> Keine Produkte gefunden. </div>";
               echo "</div>";
                }
    }
