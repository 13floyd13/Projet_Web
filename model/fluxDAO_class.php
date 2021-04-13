<?php
require_once(dirname(__FILE__).'/flux_class.php');

class FluxDAO
{
    //attributs
    private PDO $db;

    //constructeur
    function __construct()
    {
        $database = 'sqlite:'.dirname(__FILE__).'/../data/newsDB'; // Data source name
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
        if ($requete) {
            $requete->execute();
        }
        $resultat = $requete->fetchAll(PDO::FETCH_CLASS, "Flux");
        return $resultat[0];

    }

    function getNombreFlux(): int
    {
        $commandeRequete = "SELECT COUNT(DISTINCT url) FROM flux";
        $requete = $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->execute();
        }
        $resultat = $requete->fetch()['url'];
        return $resultat;
    }
    function isExistFlux($url): bool {
        $commandeRequete="SELECT url FROM flux WHERE url=$url";
        $requete=$this->db->prepare($commandeRequete);
        if($requete){
            $requete->execute();
        }
        $resultat=$requete->fetchAll();
        $requete->closeCursor();
        return count($resultat) > 0;
    }
    function addFlux($flux){
        if($this->isExistFlux($flux->url)){
            return;
        }
        $commandeRequete="INSERT INTO flux(url) VALUES($flux->url)";
        $requete= $this->db->prepare($commandeRequete);
        if($requete){
            $requete->execute();
        }
        $requete->closeCursor();
    }
}