<?php

/*
 * Description of Kateory
 *
 * @author Stefan
 */
class kategory {
    private $kategorieid;
    private $bezeichnung;
    

    public function __construct($kategorieid,$bezeichnung) {
        $this->kategorieid = $kategorieid;
        $this->bezeichnung = $bezeichnung;
    }
    
    function getKategorieid() {
        return $this->kategorieid;
    }

    function getBezeichnung() {
        return $this->bezeichnung;
    }

    function setKategorieid($kategorieid) {
        $this->kategorieid = $kategorieid;
    }

    function setBezeichnung($bezeichnung) {
        $this->bezeichnung = $bezeichnung;
    }
}
