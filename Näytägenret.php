<?php
require('./Tapahtumankäsittelijät/Tietokantayhteys.php');
$haettugenre=$_GET['hae'];
$genrekysely = "SELECT category.name, film_category.film_id, film.title
            FROM category c INNER JOIN film_category ON c.category_id 
            INNER JOIN film ON film.film_id=film_category.id
            WHERE c.name = $haettugenre";

echo "<br><a href=\"./hakulomake.php\"><b>Palaa hakulomakkeelle</b></a>";

if ($connection->query($genrekysely)){
    $result=$connection->query($genrekysely);
    $headers=$result->fetch_row(0);
    echo $headers;
    echo "<table>";
    echo "<th>Id</th>";
    echo "<th>Name</th>";
    echo "<th>Description</th>";
    while(list($category_name, $film_id, $film_title) = $result->fetch_row()){
        echo "<tr>";
        echo "<td>$category_name</td>";
        echo "<td>>$film_id</td>";
        echo "<td>>$film_title</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<br><b>Virhe kyselyssä. Genren elokuvia ei saatu haettua:</b> ".$connection->error;

}

?>