<?php
// Define a class named DataBase that extends the PDO class
class DataBase extends PDO {
    // Define private properties for database host, user, password, and name
    private $_DB_HOST = 'localhost';
    private $_DB_USER = 'root';
    private $_DB_PASS = '';
    private $_DB_NAME = 'mytable';

    // Define the constructor method
    function __construct() {
        try {
            // Call the parent constructor to connect to the database
            parent::__construct('mysql:host=' . $this->_DB_HOST . ';dbname=' . $this->_DB_NAME, $this->_DB_USER, $this->_DB_PASS);

        } catch (PDOException $exception) {
            // If a PDOException occurs, print the error message
            echo 'Erreur de connexion : ' . $exception->getMessage();
        }
    } 
}

?>