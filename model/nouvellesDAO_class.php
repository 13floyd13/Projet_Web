<?php
require_once("nouvelles_class.php");

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
        $commandeRequete="SELECT * FROM nouvelles WHERE titre= :titre AND description= :description";
        $requete = $this->db->prepare($commandeRequete);
        $requete->bindParam(':titre',$titre,PDO::PARAM_STR );
        $requete->bindParam(':description',$description,PDO::PARAM_STR);
        if($requete) {
            $requete->execute();
            $resultat = $requete->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,"Nouvelle");
            return $resultat[0];
        }
    }

    function getNouvelles(): array {
        $commandeRequete="SELECT * FROM nouvelles ORDER BY date desc";
        $requete=$this->db->prepare($commandeRequete);
        if ($requete){
            $requete->execute();
            $resultat= $requete->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,"Nouvelle");
            return $resultat;
        }
    }

    function getNouvellesParFlux(string $flux): array {
        $commandeRequete="SELECT * FROM nouvelles WHERE flux= :flux ORDER BY date desc ";
        $requete=$this->db->prepare($commandeRequete);
        $requete->bindParam(':flux',$flux,PDO::PARAM_STR);
        if ($requete){
            $requete->execute();
            $resultat= $requete->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Nouvelle");
            return $resultat;
        }
    }

    function getNombreNouvelles(): int {
        $commandeRequete = "SELECT COUNT(Distinct id) FROM nouvelles";
        $requete= $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->execute();
            $resultat= $requete->fetch();
            return $resultat[0];
        }
    }

    function isExistNouvelle(string $titre,string $description): bool {
        $commandeRequete= "SELECT id FROM nouvelles WHERE description = :description AND titre = :titre";
        $requete= $this->db->prepare($commandeRequete);
        if($requete){
            $requete->bindParam(':titre',$titre,PDO::PARAM_STR );
            $requete->bindParam(':description',$description,PDO::PARAM_STR);
            $requete->execute();
            $resultat=$requete->fetchAll();
            $requete->closeCursor();
            return count($resultat) >0;
        }
        return false;
    }

    function addNouvelle(Nouvelle $nouvelle){
        if ($this->isExistNouvelle($nouvelle->getTitre(), $nouvelle->getDescription())){
            return;
        }
        $img = $nouvelle->getImage();
        $titre = $nouvelle->getTitre();
        $description = $nouvelle->getDescription();
        $pubDate = strftime("%Y-%m-%d %H:%M:%S", strtotime($nouvelle->getDate()));
        $flux = $nouvelle->getFlux();
        $lien = $nouvelle->getLien();

        $commandeRequete = 'INSERT INTO nouvelles(date, titre, description, lien, image, flux) VALUES(:pubDate, :titre, :description, :lien, :img, :flux)';
        $requete = $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->bindParam(':pubDate',$pubDate,PDO::PARAM_STR);
            $requete->bindParam(':titre',$titre,PDO::PARAM_STR );
            $requete->bindParam(':description',$description,PDO::PARAM_STR);
            $requete->bindParam(':lien',$lien,PDO::PARAM_STR);
            $requete->bindParam(':img',$img,PDO::PARAM_STR);
            $requete->bindParam(':flux',$flux,PDO::PARAM_STR);
            $requete->execute();
            $requete->closeCursor();
        }
    }

    function removeNouvelle(Nouvelle $nouvelle){
        if ($this->isExistNouvelle($nouvelle->getTitre(), $nouvelle->getDescription())) {
            $idAdelete= $nouvelle->getId();
            $commandeRequete="DELETE FROM flux WHERE id=$idAdelete";
            $requete= $this->db->prepare($commandeRequete);
            if($requete){
                $requete->execute();
                $requete->closeCursor();
            }
        }
    }
    function getNouvellesBySearch(string $flux, string $keyword) {

        //$commandeRequete= "SELECT * FROM nouvelles WHERE flux= :flux AND titre IN (SELECT titre FROM nouvelles WHERE titre LIKE :keyword)";   //  "SELECT * FROM nouvelles WHERE flux= :flux AND titre LIKE :keyword AND description Like \"%:keyword%\" ORDER BY count(\"%:keyword%\") desc ";
        $commandeRequete = "SELECT * FROM nouvelles WHERE flux= :flux AND titre LIKE \"%$keyword%\" OR description LIKE \"%$keyword%\"";
        $requete=$this->db->prepare($commandeRequete);

        if ($requete){
            $requete->bindParam(':flux',$flux,PDO::PARAM_STR);
            //$requete->bindParam(':keyword',$keyword,PDO::PARAM_STR);
            $requete->execute();
            $resultat= $requete->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Nouvelle");
            return $resultat;
        }
    }

    private function getURLImage($nouvelle) : string
    {
        if (count($nouvelle->children('media', True)) != 0) {
            $url_image = $nouvelle->children('media', True)->content->attributes()['url'];
        } else {
            if (isset($nouvelle->enclosure)) {
                $url_image = $nouvelle->enclosure->attributes()['url'];
            }
        }

        if (isset($url_image)&&($this->extensionImage($url_image)!="")) {
            return $url_image;
        } else {
            return "";
        }
    }

    private function str_contains($haystack, $needle)
    {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }

    private function extensionImage($url)
    {
        if ($this->str_contains($url,'.jpg')||$this->str_contains($url,'.jpeg')||$this->str_contains($url,'.JPEG')||$this->str_contains($url,'.JPG')) return "jpg";
        else if ($this->str_contains($url,'.png')||$this->str_contains($url,'.PNG')) return "png";
        else if ($this->str_contains($url,'.gif')||$this->str_contains($url,'.GIF')) return "gif";
        else return "";
    }
}