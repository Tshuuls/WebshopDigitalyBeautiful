<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Zahlungsart
 *
 * @author julia
 */
class Zahlungsart {
    //put your code here
    private $userID;
    private $bezahlDatenID=0;
    private $kontonummer;
    private $kreditkartennummer;
    private $ablaufdatum;
    function getUserID() {
        return $this->userID;
    }

    function getBezahlDatenID() {
        return $this->bezahlDatenID;
    }

    function getKontonummer() {
        return $this->kontonummer;
    }

    function getKreditkartennummer() {
        return $this->kreditkartennummer;
    }

    function getAblaufdatum() {
        return $this->ablaufdatum;
    }

    function setUserID($userID) {
        if(!empty($userID)){
            $this->userID = $userID;
        }
    }

    function setBezahlDatenID($bezahlDatenID) {
        if(!empty($bezahlDatenID)){
            $this->bezahlDatenID = $bezahlDatenID;
        }
    }

    function setKontonummer($kontonummer) {
        if(!empty($kontonummer)){
            $this->kontonummer = $kontonummer;
        }else{
            $this->kontonummer = 0;
        }
    }

    function setKreditkartennummer($kreditkartennummer) {
        if(!empty($kreditkartennummer)){
            $this->kreditkartennummer = $kreditkartennummer;
        }else{
            $this->kreditkartennummer = 0;
        }
    }

    function setAblaufdatum($ablaufdatum) {
        if(!empty($ablaufdatum)){
            $this->ablaufdatum = $ablaufdatum;
        }else{
            $this->ablaufdatum = " ";
        }
    }
    
    function addAllValues($uID,$bDID,$ktn,$kkn,$ad){
        $this->setUserID($uID);
        $this->setBezahlDatenID($bDID);
        $this->setKontonummer($ktn);
        $this->setKreditkartennummer($kkn);
        $this->setAblaufdatum($ad);
    }
    function insertZahlungsArt(){
        $db =new Database();
        $query="INSERT INTO `bezahldaten`(`UserID`, `Kontonummer`, `Kreditkartennummer`, `Ablaufdatum`) VALUES ('"
                .$this->userID."','".$this->kontonummer."','".$this->kreditkartennummer."','".$this->ablaufdatum."')";
    $db->insert($query);
       // echo $query;
       
        
    }
    
    function getZahlungsArt($userID){
        $db =new Database();
        $query="SELECT * FROM `bezahldaten` WHERE `UserID` ='".$userID."'";
    }

}
