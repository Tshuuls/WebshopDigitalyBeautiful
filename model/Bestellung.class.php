<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bestellung
 *
 * @author julia
 */
class Bestellung {
    //put your code here
    private $BestellungID;
    private $UserID;
    private $Ausstellungsdatum;
    private $Rechnungsnummer;
    
    function getBestellungID() {
        return $this->BestellungID;
    }

    function getUserID() {
        return $this->UserID;
    }

    function getAusstellungsdatum() {
        return $this->Ausstellungsdatum;
    }

    function getRechnungsnummer() {
        return $this->Rechnungsnummer;
    }

    function setBestellungID($BestellungID) {
        $this->BestellungID = $BestellungID;
    }

    function setUserID($UserID) {
        $this->UserID = $UserID;
    }

    function setAusstellungsdatum($Ausstellungsdatum) {
        $this->Ausstellungsdatum = $Ausstellungsdatum;
    }

    function setRechnungsnummer($Rechnungsnummer) {
        $this->Rechnungsnummer = $Rechnungsnummer;
    }

    function adAllValues($BestellungID, $UserID, $Ausstellungsdatum, $Rechnungsnummer) {
        $this->setBestellungID($BestellungID);
        $this->setUserID($UserID);
        $this->setAusstellungsdatum($Ausstellungsdatum) ;
        $this->setRechnungsnummer($Rechnungsnummer);
    }

    function insertBestellung(){
        $db= new Database();
        $quere ="INSERT INTO `bestellung`( `UserID`,  `Rechnungsnummer`) VALUES ('".$this->UserID."','".$this->Rechnungsnummer."')";
        $db->insert($quere);
        $quere="SELECT `BestellungID` FROM `bestellung` WHERE `UserID`= '".$this->UserID."' and `Rechnungsnummer` = '".$this->Rechnungsnummer."'";
        $BS=$db->getOneBestellung($quere);
        return $BS;
    }
    
    function selectBestellungen ($BN){
        $db= new Database();
        $quere ="SELECT * FROM `bestellung`join `user` using (`UserID`) WHERE `Benutzername` like '".$BN."'";
        return $db->selectBestellungen($quere);
    }
}
