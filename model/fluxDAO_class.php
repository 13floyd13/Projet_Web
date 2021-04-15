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
            $this->db = new PDO($database);
        } catch (PDOException $e) {
            die ("Erreur : " . $e->getMessage());
        }
    }

//méthodes
    function getFlux(string $url): Flux
    {
        $commandeRequete = "SELECT * FROM flux WHERE url= :url";
        $requete = $this->db->prepare($commandeRequete);
        $requete->bindParam(':url',$url,PDO::PARAM_STR);
        if ($requete) {
            $requete->execute();
            $resultat = $requete->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Flux");
            return $resultat[0];
        }
    }

    function getNombreFlux(): int
    {
        $commandeRequete = "SELECT COUNT(DISTINCT url) FROM flux";
        $requete = $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->execute();
            $resultat = $requete->fetch()['url'];
            return $resultat;
        }
    }

    function isExistFlux(string $url): bool {
        $commandeRequete="SELECT url FROM flux WHERE url= :url";
        $requete=$this->db->prepare($commandeRequete);
        $requete->bindParam(':url',$url,PDO::PARAM_STR);
        if($requete){
            $requete->execute();
            $resultat=$requete->fetchAll();
            $requete->closeCursor();
            return count($resultat) > 0;
        }
        return false;
    }

    function addFlux(Flux $flux){
        if($this->isExistFlux($flux->getUrl())){
            return;
        }
        $url=$flux->getUrl();
        $commandeRequete='INSERT INTO flux(url) VALUES( :url)';
        $requete= $this->db->prepare($commandeRequete);
        $requete->bindParam(':url',$url,PDO::PARAM_STR);
        if($requete){
            $requete->execute();
            $requete->closeCursor();
        }
    }

    function removeFlux(Flux $flux){
        if($this->isExistFlux($flux->getUrl())){
            $urlAdelete= $flux->getUrl();
            $commandeRequete1="DELETE FROM nouvelles WHERE flux= :urlAdelete";
            $requete1=$this->db->prepare($commandeRequete1);
            $requete1->bindParam(':urlAdelete',$urlAdelete,PDO::PARAM_STR);
            if($requete1){
                $requete1->execute();
            }
            $requete1->closeCursor();
            $commandeRequete2="DELETE FROM flux_utilisateurs WHERE flux= :urlAdelete";
            $requete2=$this->db->prepare($commandeRequete2);
            $requete2->bindParam(':urlAdelete',$urlAdelete,PDO::PARAM_STR);
            if($requete2){
                $requete2->execute();
            }
            $requete2->closeCursor();
            $commandeRequete3="DELETE FROM flux WHERE url= :urlAdelete";
            $requete3= $this->db->prepare($commandeRequete3);
            $requete3->bindParam(':urlAdelete',$urlAdelete,PDO::PARAM_STR);
            if($requete3){
                $requete3->execute();
            }
            $requete3->closeCursor();
        }

    }
}