<?php

namespace App\Utils;

use PDO;
use PDOException;

class Database {
    /**
     * PDO object => database connection
     * dbh = database inneholder 
     * 
     * @var PDO
     */
    private $dbh;
    /**
     * static property of the class => unique instance of the object
     * 
     * @var Database
     */
    private static $_instance;

    /**
     * Private : only the class can create an instance
     */
    private function __construct() {
        // get data in configuration file
        // parse_ini_file parse function return an array
        $configData = parse_ini_file(__DIR__.'/../../config.ini');
        
        // PHP execute all the code in the block, but ...
        try {
            $this->dbh = new PDO(
                "mysql:host={$configData['DB_HOST']};dbname={$configData['DB_NAME']};",
                $configData['DB_USERNAME'],
                $configData['DB_PASSWORD'],
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION) //echo sql error
            );
        }
        //but, if an error (Execption), execute the block
        catch(PDOException $exception) {
            echo 'Erreur de connexion...<br>';
            echo $exception->getMessage().'<br>';
            exit;
        }
    }

    /**
     * Return dbh property (PDO object) : unique Database instance
     * 
     * @return PDO
     */
    public static function getPDO() {
        // If the unique Database instance in empty
        if (empty(self::$_instance)) {
            // create an instance in $_instance of Database
            self::$_instance = new Database();
        }
        // Else do nothing, the instance is almost create

        // Return dbh property of unique Database instance
        return self::$_instance->dbh;
    }
}
