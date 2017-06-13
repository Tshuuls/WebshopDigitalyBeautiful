<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$BA =new Bestellung();
//Prüft ob inc von Kundenverwaltung includiert wurde, setzt dementschprechend den Href link
if(isset($_GET['KID'])){
    $BN=$_GET['KID'];
    $href="kundenverwalten&type=3&KID=".$BN;
}else{//wurde von mein Konto includiert
    $BN=$_SESSION['BN'];
    $href="meinkonto&type=4";
}
if (isset($_POST['change'])){//Update Position
    $Pos= new Position();
    if($_POST['change']>0){//update
        $Pos->updateAnzahl($_GET['BID'],$_POST['PID'],$_POST['change']);
    }else{//delete
        $Pos->deletePosition($_GET['BID'],$_POST['PID']);
    }
}

//Auflistung der Bestellungen
        $Baarr= $BA->selectBestellungen($BN);
        echo "<h2>Bestellungen</h2>";
        echo"<div class='col-md-6' style='float :left'><table style='display: inline '  class=' table striped-table'>";
        echo '<th>Bestellnummer</th><th>Austellungsdatum</th><th>Aktion</th></tr>';
        
    foreach($Baarr as $zeile)
    {
        echo "<tr>";
        echo "<td>".$zeile->getBestellungID()."</td>"; 
        echo "<td>".$zeile->getAusstellungsdatum()."</td>"; 
        echo "<td class='actiongr'> <a class='glyphicon glyphicon-eye-open' href='index.php?site=".$href."&BID=".$zeile->getBestellungID()."'></a> </td>"; 
        echo "</tr>";
    }
    echo "</table></div>";
    
    
     if(isset($_GET['BID'])){//Bestellunganzeigen
         $BP = new BestellungPositionen();
         $BParr=$BP->selectBestellungsporitionen($_GET['BID']);
         if(isset($_GET['KID'])){//adminView
              echo"<div class='col-md-6 ' style='float :right'><form method='POST' action='index.php?site=kundenverwalten&type=3&KID=".$BN."&BID=".$_GET['BID']."'><table  style='display: inline' class='table striped-table'>";
              echo '<th>Produkt</th><th>Anzahl</th><th>einzel Preis</th><th>Preis</th></tr>';
              foreach($BParr as $zeile)
                {
                    echo "<tr>";
                    echo "<td>".$zeile->getName()."</td>"; 
                    echo "<td><input name='change' type='number' min='0' max='".$zeile->getAnzahl()."' value='".$zeile->getAnzahl()."'></td>"; 
                    echo "<td>".$zeile->getPreis().".-€</td>"; 
                    echo "<td>".$zeile->getAnzahl()*$zeile->getPreis().".-€</td>"; 
                    echo "</tr><input type='number' name='PID' value='".$zeile->getProduktID()."' style='display:none'>";
                }
                echo "</table><div class='form-group'>
              <div class='col-sm-offset-2 col-sm-10'>
                <button type='submit' class='btn btn-primary'>Ändern</button>
              </div>
            </div></form></div>";
            
            
        }else{//KundeView
                    $GesammtPreis=0;
                    echo"<div class='col-md-6 ' style='float :right'><table  style='display: inline' class='table striped-table'>";
                   echo '<th>Produkt</th><th>Anzahl</th><th>einzel Preis</th><th>Preis</th></tr>';
                   foreach($BParr as $zeile)
                   {
                       echo "<tr>";
                       echo "<td>".$zeile->getName()."</td>"; 
                       echo "<td>".$zeile->getAnzahl()."</td>"; 
                       echo "<td>".$zeile->getPreis().".-€</td>"; 
                       echo "<td>".$zeile->getAnzahl()*$zeile->getPreis().".-€</td>"; 
                       echo "</tr>";
                       $GesammtPreis=$GesammtPreis+$zeile->getAnzahl()*$zeile->getPreis();
                   }
                    echo "<td colspan='3'>Gesamtpreis</td>"; 
                       echo "<td>".$GesammtPreis.".-€</td>"; 
                    echo "</table>";
                    echo '<form action="./index.php?site=rechnung" method="post" target="_blank">
                        <input type="number" style="display: none" value="'.$_GET['BID'].'" name="BID">
                            <div class="form-group">
              <label for="altesPasswort" class="col-sm-4 control-label">altes Passwort*</label>
              <div class="col-sm-10">
                  <input type="password" required  pattern=".{5,15}" class="form-control" id="altesPasswort" name="altesPasswort" placeholder="Passwort">
              </div>
            </div>
                        <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Rechnung Drucken</button>
                                  </div>
                    </form></div>';
        }
     }
     ?>
