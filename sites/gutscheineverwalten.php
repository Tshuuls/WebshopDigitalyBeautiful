<?php

include 'inc/listvoucher.inc.php';

if(isset($_GET['type']))
        {
        if($_GET['type']=="1")
            {
            //Es wird kontrolliert ob ein neuer Gutschein gestellt wurde.
            if(isset($_POST['vouchID'])&&isset($_POST['vouchWert'])&&isset($_POST['vouchDate'])){
                $voucher = new Gutschein();
                $voucher->addAllValues($_POST['vouchID'], $_POST['vouchWert'],$_POST['vouchDate'], 0);
                $voucher->insertVoucher();
                 Echo "<div class='alert alert-success' role='alert'>Gutschein erfolgreich hinzugefügt <div>";
                 //Gutscheinliste wird aufgerufen.
                 listvoucher();
                }
            else{
                //neues Gutschein Formular aufrufen.
                include "./inc/newvoucher.inc.php";
                }
            }
        }
 else  {
        //Gutscheinliste wird aufgerufen.
        listvoucher();
        }
