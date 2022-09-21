<?php

require('Tietokantayhteys.php');

echo "<b>POST-muuttujat:</b>";
foreach($_POST as $key => $value){
   echo "<br>$key : $value";
}
$elokuvannimi=$_POST['title'];
$elokuvanjulkaisuvuosi=filter_input(INPUT_POST, 'release_year', FILTER_VALIDATE_INT);
$elokuvankuvaus=$_POST['description'];
$elokuvanvuokrausaika=filter_input(INPUT_POST,'rental_duration', FILTER_VALIDATE_INT);
$elokuvanvuokraushinta=filter_input(INPUT_POST,'rental_rate', FILTER_VALIDATE_FLOAT);
$elokuvankieli=$_POST['language_id'];
$alkuperäinenelokuvankieli=$_POST['original_language_id'];
$elokuvanpituus=filter_input(INPUT_POST, 'length', FILTER_VALIDATE_INT);
$elokuvankorvaushinta=filter_input(INPUT_POST, 'replacement_cost', FILTER_VALIDATE_FLOAT);
$elokuvanikäluokitus=$_POST['rating'];

if(!($elokuvanjulkaisuvuosi==false && $elokuvanvuokrausaika==false && $elokuvanvuokraushinta==false && $elokuvanpituus==false && $elokuvankorvaus==false)){


    if(isset($_POST['trailers'])){
        $elokuvanlisämateriaali_trailers=$_POST['trailers'];
    }
    if(isset($_POST['commentaries'])){
        $elokuvanlisämateriaali_commentaries=$_POST['commentaries'];
    }
    if(isset($_POST['deletedscenes'])){
        $elokuvanlisämateriaali_deletedscenes=$_POST['deletedscenes'];
    }
    if(isset($_POST['behindthescenes'])){
        $elokuvanlisämateriaali_behindthescenes=$_POST['behindthescenes'];
    }



    //Lisämateriaalit taulukkoon
    $mukaantulevat_lisämateriaalit_taulukko=array();
    if(isset($elokuvanlisämateriaali_trailers)){
        array_push($mukaantulevat_lisämateriaalit_taulukko,$elokuvanlisämateriaali_trailers);
    }

    if(isset($elokuvanlisämateriaali_commentaries)){
        array_push($mukaantulevat_lisämateriaalit_taulukko,$elokuvanlisämateriaali_commentaries);
    }

    if(isset($elokuvanlisämateriaali_deletedscenes)){
        array_push($mukaantulevat_lisämateriaalit_taulukko,$elokuvanlisämateriaali_deletedscenes);
    }

    if(isset($elokuvanlisämateriaali_behindthescenes)){
        array_push($mukaantulevat_lisämateriaalit_taulukko,$elokuvanlisämateriaali_behindthescenes);
    }

    //Muodostetaan SQL-kyselyä varten lisämateriaaleille setti
    if(count($mukaantulevat_lisämateriaalit_taulukko)==0){
        $mukaantulevat_lisämateriaalit=NULL;
    }
    else{
        if(count($mukaantulevat_lisämateriaalit_taulukko)==1){
            $mukaantulevat_lisämateriaalit="('".$mukaantulevat_lisämateriaalit_taulukko[0]."')";
        }
        else{
            $mukaantulevat_lisämateriaalit="(";
        
            foreach($mukaantulevat_lisämateriaalit_taulukko as $value){
                if(array_search($value,$mukaantulevat_lisämateriaalit_taulukko)==0){
                    $mukaantulevat_lisämateriaalit.="'".$value;                   
                }
                else{
                $mukaantulevat_lisämateriaalit.=",".$value;
                }
            }
        
            $mukaantulevat_lisämateriaalit.="')";
        }
    }

        
    $syöttökysely="INSERT INTO film VALUES(
        NULL,
        '$elokuvannimi',
        '$elokuvankuvaus',
        $elokuvanjulkaisuvuosi,
        $elokuvankieli,
        $alkuperäinenelokuvankieli,
        $elokuvanvuokrausaika,
        $elokuvanvuokraushinta,
        $elokuvanpituus,
        $elokuvankorvaushinta,
        '$elokuvanikäluokitus',
        $mukaantulevat_lisämateriaalit,
        NULL           
        )";

        echo "<p>SYÖTTÖKYSELY:".$syöttökysely."</p>";

        if ($connection->query($syöttökysely)){
            echo "<br>Elokuvan lisäys onnistui";
            header('Location: ../hakulomake.php?uusielokuvalisatty=kylla');
        } else {
            $virheviesti="<br>Virhe kyselyssä, kaikkia henkilöitä ei saatu lisättyä: " . $connection->error;
            header('Location: ../hakulomake.php?uusielokuvalisatty=ei&virheviesti='.$virheviesti);
        }
} else {
    $virheviesti="<br>Virheelliset tiedot, julkaisuvuosi, vuokrausaika tai vuokraushinta ei ole väärässä muodossa: " . $connection->error;
    header('Location: ../hakulomake.php?uusielokuvalisatty=ei&virheviesti='.$virheviesti);
}
?>