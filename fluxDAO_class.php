<?php
require_once(dirname(__FILE__).'/Projet_Web.php');

class fluxDAO
{
    //attributs
    private PDO $db;

    //constructeur
    function __construct()
    {
        $database = 'sqlite:newsDB'; // Data source name
        try {
            $db = new PDO($database);
        } catch (PDOException $e) {
            die ("Erreur : " . $e->getMessage());
        }
    }

//méthodes
    function get(int $url): Flux
    {
        $commandeRequete = "SELECT * FROM flux WHERE url=$url";
        $requete = $this->db->prepare($commandeRequete);
        $requete->execute();
        $resultat = $requete->fetchAll(PDO::FETCH_CLASS, "Flux");
        return $resultat[0];

    }
//$flux= $this->db->query($commandeRequete);
//        $result=$flux->fetchall(PDO::FETCH_CLASS;"Flux");
//        return $result[0];

    function getNombreFlux(): int
    {
        $commandeRequete = "SELECT COUNT(DISTINCT url) FROM flux";
        $requete = $this->db->prepare($commandeRequete);
        $requete->execute();
        $resultat = $requete->fetch()['url'];
        return $resultat;
    }
}