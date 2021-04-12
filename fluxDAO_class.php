<?php
require_once flux_class.php;

class fluxDAO
{
    private $db;

    function __construct()
    {
        $database = 'sqlite:newsDB'; // Data source name
        try {

            $db = new PDO($database);
        } catch (PDOException $e) {
            die ("Erreur : " . $e->getMessage());
        }
    }
}