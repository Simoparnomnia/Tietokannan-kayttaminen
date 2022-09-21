#TIETOKANNAN KÄYTTÄMINEN, OMNIA
#README

###Introduction

####movie database application/repository experiment with XAMPP/PHP/MySQL for the [Omnia](https://www.omnia.fi/en) web programming (Web-ohjelmointi) course. 

###Setup instructions for Windows

####XAMPP/PHP
Make sure you have the latest version of XAMPP installed with PHP 8.0.6
XAMPP is typically located in C:/Xampp in Windows. XAMPP control panel can be launched from Xampp/Xampp-control.exe
####Composer for CLI and Visual Studio Code
[Composer, PHP dependency manager installer instructions for CLI](https://getcomposer.org/download/), open XAMPP and run the commands in XAMPP control panel -> XAMPP shell
####Composer for Visual Studio Code
Install the [Composer extension for Visual Studio Code](https://marketplace.visualstudio.com/items?itemName=ikappas.composer) afterwards
####Project dependencies
[composer.json, configuration file for dependencies](https://getcomposer.org/doc/01-basic-usage.md#composer-json-project-setup), make sure this is installed
[monolog](https://packagist.org/packages/monolog/monolog), only version 2.2.* works for the latest XAMPP version (PHP 8.0.6)
[phpunit, unit testing](https://packagist.org/packages/phpunit/phpunit), only versions 9.5.*
####Database and database material
Start the MySQL from your XAMPP control panel
[Download the Sakila database](https://dev.mysql.com/doc/index-other.html) and execute the SQL files in XAMPP PHPMyAdmin or the command line interface for the external MySQL/MariaDB DBMS your XAMPP is configured for. If you are using an external DBMS with the default port 3306, XAMPP should find this automatically  

###Project folders
####Grafiikkakompnentit
Reusable graphic components are defined here
####Tapahtumankäsittelijät
PHP event handlers for database inserts with form input are defined here
####.gitignore
Ignored files for the remote repository are configured here
####composer.json
[Instructions](https://getcomposer.org/doc/01-basic-usage.md#composer-json-project-setup)
####composer.lock
Installed dependencies
####composer.phar
The PHP archive (phar) for the dependency manager
####Ignored folders
See also the .gitignore file
Tapahtumankäsittelijät/Tietokantayhteys.php, configure the database connection file:
    <?php
    $servername = "localhost";
    $username = "usernamehere";
    $password = "passwordhere";
    $db="sakila";



    // Create database connection
    $connection = new mysqli($servername, $username, $password, $db);
    // Check connection
    if ($connection->connect_error) {
        die("Tietokantayhteys epäonnistui: " . $connection->connect_error);
    } 



    ?>  