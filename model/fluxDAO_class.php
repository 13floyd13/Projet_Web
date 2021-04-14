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
    function getFlux(int $url): Flux
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
    function isExistFlux(string $url): bool {
        $commandeRequete="SELECT url FROM flux WHERE url=$url";
        $requete=$this->db->prepare($commandeRequete);
        if($requete){
            $requete->execute();
        }
        $resultat=$requete->fetchAll();
        $requete->closeCursor();
        return count($resultat) > 0;
    }
    function addFlux(Flux $flux){
        if($this->isExistFlux($flux->getUrl())){
            return;
        }
        $commandeRequete="INSERT INTO flux(url) VALUES($flux->getUrl())";
        $requete= $this->db->prepare($commandeRequete);
        if($requete){
            $requete->execute();
        }
        $requete->closeCursor();
    }
    function removeFlux(Flux $flux){
        if($this->isExistFlux($flux->getUrl())){
            $urlAdelete= $flux->getUrl();
            $commandeRequete1="DELETE FROM nouvelles WHERE flux=$urlAdelete";
            $requete1=$this->db->prepare($commandeRequete1);
            if($requete1){
                $requete1->execute();
            }
            $requete1->closeCursor();
            $commandeRequete2="DELETE FROM flux_utilisateurs WHERE flux=$urlAdelete";
            $requete2=$this->db->prepare($commandeRequete2);
            if($requete2){
                $requete2->execute();
            }
            $requete2->closeCursor();
            $commandeRequete3="DELETE FROM flux WHERE url=$urlAdelete";
            $requete3= $this->db->prepare($commandeRequete3);
            if($requete3){
                $requete3->execute();
            }
            $requete3->closeCursor();
        }

    }
}