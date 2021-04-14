<?php
require_once(dirname(__FILE__).'/nouvelles_class.php');
require_once(direname(__FILE__).'/../controler/util.php');

class NouvellesDAO
{
    //attributs
    private PDO $db;

    //constructeurs
    function __construct()
    {
        $database = 'sqlite:' . dirname(__FILE__) . '/../data/newsDB'; // Data source name
        try {
            $this->db = new PDO($database);
        } catch (PDOException $e) {
            die ("Erreur : " . $e->getMessage());
        }
    }

    function getNouvelle(string $titre,string $description): Nouvelle{
        $titre= $this->db->quote($titre);
        $description=$this->db->quote($description);
        $commandeRequete="SELECT * FROM nouvelles WHERE titre=$titre AND description=$description";
        $requete = $this->db->prepare($commandeRequete);
        if($requete) {
            $requete->execute();
        }
        $resultat = $requete->fetchAll(PDO::FETCH_CLASS,"Nouvelle");
        return $resultat[0];
    }
    function getNouvelles(): Nouvelle{
        $commandeRequete="SELECT * FROM nouvelles";
        $requete=$this->db->prepare($commandeRequete);
        if ($requete){
            $requete->execute();
        }
        $resultat= $requete->fetchAll(PDO::FETCH_CLASS,"Nouvelle");
        return $resultat;
    }
    function getNouvellesParFlux(string $flux): Nouvelle{
        $commandeRequete="SELECT * FROM nouvelles WHERE flux=$flux";
        $requete=$this->db->prepare($commandeRequete);
        if ($requete){
            $requete->execute();
        }
        $resultat= $requete->fetchAll(PDO::FETCH_CLASS, "Nouvelle");
        return $resultat;
    }

    function getNombreNouvelles(): int {
        $commandeRequete = "SELECT COUNT(Distinct id) FROM nouvelles";
        $requete= $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->execute();
        }
        $resultat= $requete->fetch()['id'];
        return $resultat;
    }
    function isExistNouvelle(string $titre,string $description): bool{
        $titre= $this->db->quote($titre);
        $description=$this->db->quote($description);
        $commandeRequete= "SELECT id FROM nouvelles WHERE description = $description AND titre = $titre";
        $requete= $this->db->prepare($commandeRequete);
        if($requete){
            $requete->execute();
        }
        $resultat=$requete->fetchAll();
        $requete->closeCursor();
        return count($resultat) >0;
    }
    function addNouvelle(Nouvelle $nouvelle){
        if ($this->isExistNouvelle($nouvelle->getTitre(), $nouvelle->getDescription())){
            return;
        }
        $url_image = getURLImage($nouvelle);
        $img = "";
        if ($url_image != "")
            $img = '../data/images/image' . getNombreNouvelles($this->db) . '.' . extensionImage($url_image);

        $titre = $this->db->quote($nouvelle->getTitre());
        $description = $this->db->quote($nouvelle->getDescription());
        $pubDate = strftime("%Y-%m-%d %H:%M:%S", strtotime($nouvelle->pubDate));
        $flux = $this->db->quote($nouvelle->getFlux());

        $commandeRequete = 'INSERT INTO nouvelles(date, titre, description, lien, image, flux) VALUES(\'' . $pubDate . '\', ' . $titre . ', ' . $description . ', \'' . $nouvelle->link . '\', \'' . $img . '\', ' . $nouvelle->getFlux() . ')';
        $requete = $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->execute();
        }
        $requete->closeCursor();
    }
    function removeNouvelle(Nouvelle $nouvelle){
        if ($this->isExistNouvelle($nouvelle->getTitre(), $nouvelle->getDescription())){
            $idAdelete= $nouvelle->getId();
            $commandeRequete="DELETE FROM flux WHERE id=$idAdelete";
            $requete= $this->db->prepare($commandeRequete);
            if($requete){
                $requete->execute();
            }
            $requete->closeCursor();

        }
    }


}