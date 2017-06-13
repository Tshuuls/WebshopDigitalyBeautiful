
<?php

$BID=$_POST['BID'];
$BN=$_SESSION['BN'];
$user = new User();
$user= $user->selectOneUserByName($BN);
$BP= new BestellungPositionen();
$BParr=$BP->selectBestellungsporitionen($BID);
$GesammtPreis=0;
echo "<div class='container' style='top:55px; position: relative'><div class='col-md-6' ><ul style='list-style: none;'>
    <li>".$user->getAnrede()."</li>
    <li>".$user->getVorname()." ".$user->getNachname()."</li>
    <li>".$user->getAdresse()."</li>
    <li>".$user->getPLZ()." ".$user->getOrt()."</li>
</ul>";
echo"<table  style='display: inline' class='table striped-table'>";
                   echo '<th>Produkt</th><th>Anzahl</th><th>einzel Preis</th><th>Preis</th></tr>';
                   foreach($BParr as $zeile)
                   {
                       echo "<tr>";
                       echo "<td>".$zeile->getName()."</td>"; 
                       echo "<td>".$zeile->getAnzahl()."</td>"; 
                       echo "<td>".$zeile->getPreis()." .-€</td>"; 
                       echo "<td>".$zeile->getAnzahl()*$zeile->getPreis()." .-€</td>"; 
                       echo "</tr>";
                       $GesammtPreis=$GesammtPreis+$zeile->getAnzahl()*$zeile->getPreis();
                   }
                    echo "<td colspan='3'>Gesamtpreis</td>"; 
                       echo "<td>".$GesammtPreis." .-€</td>"; 
                    echo "</table>";
                    echo '</div>';