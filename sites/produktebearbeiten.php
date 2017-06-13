


    <?php
   // include 'model/Database.class.php';
    //include './model/Product.class.php';
    include 'inc/listproducts.inc.php';
    
    if(isset($_GET['type']))
        {
        if($_GET['type']=="1")
            {
              
            if(isset($_POST['prodName'])&&isset($_POST['prodBeschreibung'])&&isset($_POST['prodPreis'])){
                //Neues Produkt anlegen
                //Bildupload checken und Bild umkopieren
                
                $prod = new Product();
                $foto = uniqid();
                $prod->setFoto($foto);
                if(!$_FILES['prodPic']['error']) {
                    move_uploaded_file($_FILES['prodPic']['tmp_name'], "pictures/$foto.jpg");
                    }
                else{
                    $file = "pictures/beispielbild.jpg";
                    $newfile = "pictures/$foto.jpg";
                    copy($file, $newfile);
                    }
                
                //Übergebene Parameter überprüfen und zuweisen
                if(isset($_POST['prodName'])&&!empty(trim($_POST['prodName']))){ 
                    $prod->setName(secureString($_POST['prodName']));
                    }
                if(isset($_POST['prodBeschreibung'])&&!empty(trim($_POST['prodBeschreibung']))){ 
                    $prod->setBeschreibung(secureString($_POST['prodBeschreibung']));
                    }
                if(isset($_POST['prodPreis'])&&$_POST['prodPreis']>0){ 
                    $prod->setPreis($_POST['prodPreis']);
                    }
                if(isset($_POST['prodBewertung'])){
                    if ($_POST['prodBewertung']>0&&$_POST['prodBewertung']<6){
                        $prod->setBewertung($_POST['prodBewertung']);
                        }
                    else {
                        $prod->setBewertung(3);
                        }
                    }
                $prod->setKategorieid($_POST['prodKat']);
                 
                //Produkt in Datenbank insterten
                $prod->insertProduct();
                Echo "<div class='alert alert-success' role='alert'>Produkt hinzugefügt<div>";
                // Produktliste Anzeigen
                listproducts();
            }
            
            else {
                //Neues Produktformular aufrufen
                include './inc/newproduct.inc.php';
            }
        }    
        if($_GET['type']=="2" and isset($_GET['PID']))
        {
                                   
            if(isset($_POST['prodName'])&&isset($_POST['prodBeschreibung'])&&isset($_POST['prodPreis'])){
                $prod = new Product();
                $prod->setProduktid($_GET['PID']);
                if(!$_FILES['prodPic']['error']) {
                    $foto = uniqid();
                    $prod->setFoto($foto);
                    move_uploaded_file($_FILES['prodPic']['tmp_name'], "pictures/$foto.jpg");
                    }
                else {
                    $prod->setFoto("False");
                    }
                //Übergebene Parameter überprüfen und zuweisen
                if(isset($_POST['prodName'])&&!empty(trim($_POST['prodName']))){
                    $prod->setName(secureString($_POST['prodName']));
                    }
                if(isset($_POST['prodBeschreibung'])&&!empty(trim($_POST['prodBeschreibung']))){ 
                   
                    $prod->setBeschreibung(secureString($_POST['prodBeschreibung']));
                    }
                if(isset($_POST['prodPreis'])&&$_POST['prodPreis']>0){ 
                    $prod->setPreis($_POST['prodPreis']);
                    }
                if(isset($_POST['prodBewertung'])){
                    if ($_POST['prodBewertung']>0&&$_POST['prodBewertung']<6){
                            $prod->setBewertung($_POST['prodBewertung']);
                    }
                    else {
                        $prod->setBewertung(3);
                        }
                }
                $prod->setKategorieid($_POST['prodKat']);
                //Produktupdate wird durchgeführt;
                $prod->updateProduct();
               Echo "<div class='alert alert-success' role='alert'>Produkt aktualisiert<div>";
                // Produktliste Anzeigen
                listproducts();
            }
            else {
                $prodedit = new Product();
                $db = new Database();
                $prodedit = $db->getProduct($_GET['PID']);
                include './inc/editproduct.inc.php';
            }
                
        } 
            
        if($_GET['type']=="3"&&isset($_GET['PID']))
        {
         $db = new Database;
         $delprod = $db->getProduct($_GET['PID']);
         $delprod->deleteProduct();
        Echo "<div class='alert alert-success' role='alert'>Produkt wurde gelöscht. <div>";
        // Produktliste Anzeigen
        listproducts();
        }
            
        
    }
    else {
        // Produktliste Anzeigen
        listproducts();
        }

    ?>
