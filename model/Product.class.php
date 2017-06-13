<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author Stefan
 */
class Product {
    //put your code here
    private $produktid;
    private $name;
    private $beschreibung;
    private $bewertung;
    private $preis;
    private $foto;
    private $kategorieid;
    private $kategoriebezeichnung;
    
    function __construct(){
        
    }
      
    function withparam($produktid,$name,$beschreibung,$bewertung,$preis,$foto,$kategorieid,$kathegoriebezeichnung) {
        $this->produktid = $produktid;
        $this->name = $name;
        $this->beschreibung = $beschreibung;
        $this->bewertung = $bewertung;
        $this->preis = $preis;
        $this->foto = $foto;
        $this->kategorieid = $kategorieid;     
        $this->kategoriebezeichnung = $kathegoriebezeichnung;
    }
    function getName() {
        return $this->name;
    }

    function setName($name) {
        $this->name = $name;
    }

    function getProduktid() {
        return $this->produktid;
    }

    function getBeschreibung() {
        return $this->beschreibung;
    }

    function getBewertung() {
        return $this->bewertung;
    }

    function getPreis() {
        return $this->preis;
    }

    function getFoto() {
        return $this->foto;
    }

    function getKategorieid() {
        return $this->kategorieid;
    }
    
    function getKategoriebeschreibung() {
        return $this->kategoriebezeichnung;
    }

    function setProduktid($produktid) {
        $this->produktid = $produktid;
    }

    function setBeschreibung($beschreibung) {
        $this->beschreibung = $beschreibung;
    }

    function setBewertung($bewertung) {
        $this->bewertung = $bewertung;
    }

    function setPreis($preis) {
        $this->preis = $preis;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function setKategorieid($kategorieid) {
        $this->kategorieid = $kategorieid;
    }

    function setKategoriebeschreibung($kategoriebeschreibung) {
        $this->kategoriebeschreibung = $kategoriebeschreibung;
    }
    
    function insertProduct(){
        $db =new Database();
        $query="INSERT INTO `produkte`(`Name`, `Beschreibung`, `Bewertung`, `Preis`, `Foto`, `KategorieID`) VALUES "
                ."('".$this->name."','".$this->beschreibung."','".$this->bewertung."','".$this->preis."','".$this->foto."','".$this->kategorieid."')";
        $db->insert($query);
    }
    
    function deleteProduct(){
        $db =new Database();
        $stmt = "DELETE FROM `produkte` WHERE `ProduktID`=".$this->produktid;
        unlink("pictures/".$this->foto.".jpg");
        $db->deleteIt($stmt);
    }
    
    function updateProduct(){
        $db =new Database();
        if($this->foto = "false" or empty(trim($this->foto))) {
            $query="UPDATE `produkte` SET `Name`='".$this->name."',`Beschreibung`='".$this->beschreibung."',`Bewertung`='".$this->bewertung."',`Preis`='".$this->preis."',`KategorieID`='".$this->kategorieid."' WHERE `ProduktID`=".$this->produktid;
            
        }
        else {
            $query="UPDATE `produkte` SET `Name`='".$this->name."',`Beschreibung`='".$this->beschreibung."',`Bewertung`='".$this->bewertung."',`Preis`='".$this->preis."',`Foto`='".$this->foto."',`KategorieID`='".$this->kategorieid."' WHERE `ProduktID`=".$this->produktid;
        }
        $db->insert($query);
    }
    
}