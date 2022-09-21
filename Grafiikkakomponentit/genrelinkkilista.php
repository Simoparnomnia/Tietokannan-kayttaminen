<?php
require('./Tapahtumankäsittelijät/Tietokantayhteys.php');

$genrekysely="SELECT DISTINCT name FROM category";

if ($connection->query($genrekysely)){
    $result=$connection->query($genrekysely);
    while(list($name) = $result->fetch_row()){
        echo "<a href=\".\\Näytägenret.php?hae=$name\">$name</a>";
    }
} else {
    echo "<br><b>Virheellinen kysely, genrejä ei saatu haettua</b>";

}
?>