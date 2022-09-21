<?php
//if(isset(¤_GET['hae'])){
//$nimi=$_GET['nimi'];
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Sakila hakulomake</title>
</head>
<body>

<?php
    require('./Tapahtumankäsittelijät/Tietokantayhteys.php');
    
    if(isset($_GET["uusielokuvalisatty"])){
        if($_GET["uusielokuvalisatty"]=="kylla"){
            echo "<br><b>Uuden elokuvan lisäys onnistui</b>";
        }
        else{
            echo "<br><b>".$_GET["virheviesti"]."</b>";
        }
    }

    ?>

    <br><h2>Hae elokuvat genreittäin</h2>

<?php
    require('./Grafiikkakomponentit/Genrelinkkilista.php');
?>


    <br><h3>Lisätietoa: https://dev.mysql.com/doc/sakila/en/sakila-structure.html</h3>

    <form method="get" action=".\Haeeelokuva.php">
        <label><h2>Hae elokuvaa Sakila-tietokannasta.</h3></label>
        <input name="nimi" required/>
        <input type="submit" name="hae" value="Hae"/>
    </form>

    <form method="post" action=".\Tapahtumankäsittelijät\Käsitteleuusielokuva.php">
        <label><h2>Tallenna uusi elokuva Sakila-tietokantaan.</h2></label>
        <label><b>Nimi</b></label>
        <input type="text" name="title" required/>
        <label><b>Julkaisuvuosi</b></label>
        <input type="text" name="release_year" required/>
        <label><b>Elokuvan kuvaus</b></label>
        <input type="text" name="description" required/>
        <label><b>Vuokrausaika päivissä</b></label>
        <input type="text" name="rental_duration" required/>
        <label><b>Vuokraushinta / päivä (muotoa K.DDDDD)</b></label>
        <input type="text" name="rental_rate" required/>
        <label><b>Kieli</b></label>
        <select name="language_id">
        <!--?php
        while(list($id,$name)=$result->fetch_row()){
            if(isset($_POST['language_id']) && $_POST['language_id']==$id){
                $selected=" selected=\"selected\""; 
            }
            else{
                $selected="";
            }
            echo "<br><option value=\"$id\"$selected>$name</option>";
        }
        ?>-->
        <option value="1">English</option>
        <option value="2">Italian</option>
        <option value="3">Japanese</option>
        <option value="4">Mandarin</option>
        <option value="5">French</option>
        <option value="6">German</option>
        </select>
        <label><b>Alkuperäinen kieli</b></label>
        <select name="original_language_id">
        <!--?php
        while(list($id,$name)=$result->fetch_row()){
            if(isset($_POST['original_language_id']) && $_POST['original_language_id']==$id){
                $selected=" selected=\"selected\"";
            }
            else{
                $selected="";
            }
            echo "<br><option value=\"$id\"$selected>$name</option>";
        }
        ?>-->
        <option value="1">English</option>
        <option value="2">Italian</option>
        <option value="3">Japanese</option>
        <option value="4">Mandarin</option>
        <option value="5">French</option>
        <option value="6">German</option>
        </select>
        <label><b>Elokuvan pituus minuuteissa</b></label>
        <input type="text" name="length" required/>
        <label><b>Elokuvan korvaushinta</b></label>
        <input type="text" name="replacement_cost" required/>
        <label><b>Elokuvan ikäluokitus</b></label>
        <select name="rating">
        <!--?php
        $sql="SELECT rating FROM film 
            GROUP BY rating";
        if ($result = $mysqli -> query($sql)) {
            while ($row = $result -> fetch_row()) {
            
            $features=trim(substr($row['Type'],3),'()');
            $featuresstrarray=explode(',',$features);
            foreach($featuresstrarray as $feature){
                $trimmedfeature=trim($feature,"'");
            }

        ?>-->
        <option value="G">General Audiences (G)</option>
        <option value="PG">Parental Guidance (PG)</option>
        <option value="PG-13">Parents Strongly Cautioned (PG-13)</option>
        <option value="R">Restricted (R)</option>
        <option value="NC-17">No One 17 And Under Admitted (NC-17)</option>
        </select>
        <label><b>Elokuvan lisämateriaalit</b></label>
        <!--?php
            foreach($ratingstrarray as $rating){
                $trimmedrating=trim($rating,"'");
                $rating_set=(isset($_POST['rating'] and $r==$_POST['rating'])


            }     

        ?>-->
        <label for="trailers"><b>Trailers</b></label>
        <input type="checkbox" name="trailers" value="Trailers">
        <label for="commentaries"><b>Commentaries</b></label>
        <input type="checkbox" name="commentaries" value="Commentaries">
        <label for="deleted scenes"><b>Deleted Scenes</b></label>
        <input type="checkbox" name="deletedscenes" value="Deleted Scenes">
        <label for="behind the scenes"><b>Behind the Scenes</b></label>
        <input type="checkbox" name="behindthescenes" value="Behind the Scenes">
        <input type="submit" name="hae" value="Syötä uusi elokuva"/>
    </form>

</body>
</html>

<?php

    
    //if($isset($tulokset)){
    //    if($tulokset){
    //
    //    }
    //    else{
    //       echo "<br>Haettavia tietoja ei löytynyt";
    //    }
    //}





    $connection -> close();
?>