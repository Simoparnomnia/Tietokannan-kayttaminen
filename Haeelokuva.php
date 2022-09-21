<?php

require('./Tapahtumankäsittelijät/Tietokantayhteys.php');

$haettuelokuva=$_GET["nimi"];

echo "<br>Haettu elokuva: $haettuelokuva";


$hakukysely="SELECT * FROM film WHERE title='$haettuelokuva'";

echo "<br>Hakukysely: $hakukysely";

echo "<br><a href=\"../hakulomake.php\"><b>Palaa hakulomakkeelle</b></a>";

if ($connection->query($hakukysely)){
    $result=$connection->query($hakukysely);
    echo "<br>Haun tulos:";
   

    if($result->num_rows > 0){
        
        echo "<table>";
        echo "<th>Id</th>";
        echo "<th>Name</th>";
        echo "<th>Description</th>";
        echo "<th>Release year</th>";
        echo "<th>Language id</th>";
        echo "<th>Original language id</th>";
        echo "<th>Rental duration</th>";
        echo "<th>Rental rate</th>";
        echo "<th>length</th>";
        echo "<th>Replacement cost</th>";
        echo "<th>Rating</th>";
        echo "<th>Special features</th>";
        echo "<th>Last update</th>";
        
        while(list($id,$name,$description,$release_year,$language_id,$original_language_id,$rental_duration,$rental_rate,$length,$replacement_cost,$rating,$special_features,$last_update) = $result->fetch_row()){
        
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$name</td>";
            echo "<td>$description</td>";
            echo "<td>$release_year</td>";
            echo "<td>$language_id</td>";
            echo "<td>$original_language_id</td>";
            echo "<td>$rental_duration</td>";
            echo "<td>$rental_rate</td>";
            echo "<td>$length</td>";
            echo "<td>$replacement_cost</td>";
            echo "<td>$rating</td>";
            echo "<td>$special_features</td>";
            echo "<td>$last_update</td>";
            echo "</tr>";

        }

        echo "</table>";
    }
    else{
        echo "<br><b>Elokuvaa ei löytynyt</b>";
    }
    
    
} else {
    $virheviesti="<br>Virhe kyselyssä: $connection->error ";
    echo $virheviesti;
    //header('Location: ../hakulomake.php?elokuvaloydetty=ei&virheviesti='.$virheviesti);
}



?>