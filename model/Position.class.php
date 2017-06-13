<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Position
 *
 * @author julia
 */
class Position {
    //put your code here
    private $BestellungID;
    private $ProduktID;
    private $Anzahl;
    
    function getBestellungID() {
        return $this->BestellungID;
    }

    function getProduktID() {
        return $this->ProduktID;
    }

    function getAnzahl() {
        return $this->Anzahl;
    }

    function setBestellungID($BestellungID) {
        $this->BestellungID = $BestellungID;
    }

    function setProduktID($ProduktID) {
        $this->ProduktID = $ProduktID;
    }

    function setAnzahl($Anzahl) {
        $this->Anzahl = $Anzahl;
    }

    function adAllValues($BestellungID, $ProduktID, $Anzahl) {
        $this->BestellungID = $BestellungID;
        $this->ProduktID = $ProduktID;
        $this->Anzahl = $Anzahl;
    }
    
    function insertPosition($posID,$BestID,$anz){
        $db = new Database();
        $quere="INSERT INTO `position`(`BestellungID`, `ProduktID`, `Anzahl`) VALUES ('".$BestID."','".$posID."','".$anz."')";
        $db->insert($quere);
    }
    
    function updateAnzahl($BID,$PID,$Anz){
        $db = new Database();
        $quere="UPDATE `position` SET `Anzahl`='".$Anz."' WHERE `BestellungID` ='".$BID."' and `ProduktID`='".$PID."'";
        //echo $quere;
        $db->update($quere);
    }
    
    function deletePosition($BID,$PID){
        $db = new Database();
        $quere="DELETE FROM `position` WHERE `BestellungID` ='".$BID."' and `ProduktID`='".$PID."'";
        //echo $quere;
        $db->deleteIt($quere);
    }

}
