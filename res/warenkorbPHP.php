
        <?php
        session_start();
        //Produkt zum Warenkorb hinzufügen
        if($_POST['operation'] == 'add')
        {
            array_push($_SESSION['warenkorb'], $_POST['produkt']);
            echo "<script>updateWarenkorbCount(".count($_SESSION['warenkorb']).")</script>";
        }
        //Produkt löschen; entweder nut entfernen oder Warenkorb leeren, wenn letztes Produkt gelöscht werden soll
        elseif($_POST['operation'] == 'löschen')
        {
           if(($key = array_search($_POST['produkt'], $_SESSION['warenkorb'])) !== false) {
               if(count($_SESSION['warenkorb']==1)){
                   $_SESSION['warenkorb']=array();
               }else{
                    unset($_SESSION['warenkorb'][$key]);
               }
            }
            echo "<script>updateWarenkorbCount(".count($_SESSION['warenkorb']).")</script>";
        }
        //Ganzen Warenkorb löschen
        elseif($_POST['operation'] == 'alleslöschen')
        {
           $_SESSION['warenkorb']=array();
           echo "<script>updateWarenkorbCount(".count($_SESSION['warenkorb']).")</script>";
           
        }
        
        //Function zum händling einer Anzahl änderung
        elseif($_POST['operation'] == 'change')
        {
            
            $duplicateCount = array_count_values($_SESSION['warenkorb']);
            if(count($duplicateCount)>0){
                $ProdCount=$duplicateCount[$_POST['produkt']];
                //Anzahl wurde erhöht
               if ($_POST['change']>$ProdCount){
                   array_push($_SESSION['warenkorb'], $_POST['produkt']);
                //echo "<script>updateWarenkorbCount(".count($_SESSION['warenkorb']).")</script>";

               }else{//anzahl wurde erniedrigt
                   if(($key = array_search($_POST['produkt'], $_SESSION['warenkorb'])) !== false) {
                    unset($_SESSION['warenkorb'][$key]);
                   }
                }
                
                echo "<script>updateWarenkorbCount(".count($_SESSION['warenkorb']).")</script>";
                $duplicateCount = array_count_values($_SESSION['warenkorb']);
                if(count($duplicateCount)>0 && $key = array_search($_POST['produkt'], $_SESSION['warenkorb']) !== false){
                    $ProdCount=$duplicateCount[$_POST['produkt']];
                    
                    echo "<script>updateProduktPreis(".$_POST['produkt'].",".$_POST['preis'].",".$ProdCount.",".$_POST['change'].")</script>";
                }else{
                    
                    echo "<script>updateProduktPreis(".$_POST['produkt'].",".$_POST['preis'].",0)</script>";
                }
                 
                  
                
               }
            
            else{
                
            }
        }
        ?>


