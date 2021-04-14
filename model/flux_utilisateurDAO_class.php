<?php
include(dirname(__FILE__).'/flux_utilisateur_class.php');


class Flux_utilisateurDAO
{

    private PDO $db;

    function __construct()
    {
        $database = 'sqlite:' . dirname(__FILE__) . '/../data/newsDB'; // Data source name
        try {
            $this->db = new PDO($database);
        } catch (PDOException $e) {
            die ("Erreur : " . $e->getMessage());
        }
    }

    function getNomFlux_utilisateur(string $flux,string $login): Flux_utilisateur
    {
        $login = $this->db->quote($login);
        $commandeRequete = "SELECT * FROM flux_utilisateur WHERE flux=$flux AND login=$login";
        $requete = $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->execute();
        }
        $resultat = $requete->fetchAll(PDO::FETCH_CLASS, "Flux_utilisateur");
        return $resultat[0];
    }

    function getFlux_utilisateur(string $nom,string $login): Flux_utilisateur
    {
        $login = $this->db->quote($login);
        $nom = $this->db->quote($nom);
        $commandeRequete = "SELECT * FROM flux_utilisateur WHERE nom=$nom AND login=$login";
        $requete = $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->execute();
        }
        $resultat = $requete->fetchAll(PDO::FETCH_CLASS, "Flux_utilisateur");
        return $resultat[0];
    }
    function getFlux_utilisateurByLogin(string $login): array
    {
        $login = $this->db->quote($login);
        $commandeRequete = "SELECT * FROM flux_utilisateur WHERE login=$login";
        $requete = $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->execute();
        }
        $resultat = $requete->fetchAll(PDO::FETCH_CLASS, "Flux_utilisateur");
        return $resultat;
    }

    function getNombreFlux_utilisateur(): int
    {
        $commandeRequete = "SELECT COUNT(Distinct flux) FROM flux_utilisateurs";
        $requete = $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->execute();
        }
        $resultat = $requete->fetch()['flux'];
        return $resultat;
    }

    function isExistFlux_utilisateur(string $login,string $flux): bool
    {
        $login = $this->db->quote($login);
        $commandeRequete = "SELECT * FROM nouvelles WHERE flux=$flux AND login=$login";
        $requete = $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->execute();
        }
        $resultat = $requete->fetchAll();
        $requete->closeCursor();
        return count($resultat) > 0;
    }
    function addFlux_utilisateur(Flux_utilisateur $flux_utilisateur){
        if($this->isExistFlux_utilisateur($flux_utilisateur->getLogin(),$flux_utilisateur->getFlux())){
            return;
        }
        $login = $this->db->quote($flux_utilisateur->getLogin());
        $nom = $this->db->quote($flux_utilisateur->getNom());
        $categorie = $this->db->quote($flux_utilisateur->getCategorie());
        $commandeRequete = 'INSERT INTO nouvelles(flux, login, nom, categorie) VALUES(\'' . $flux_utilisateur->getFlux() . '\', ' . $login . ', ' . $nom . ', ' . $categorie . ')';
        $requete = $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->execute();
        }
        $requete->closeCursor();
    }
    function removeFlux_utilisateur(Flux_utilisateur $flux_utilisateur){
        if($this->isExistFlux_utilisateur()){
            $fluxAdelete= $flux_utilisateur->getFlux();
            $commandeRequete="DELETE FROM flux WHERE flux=$flux_utilisateur";
            $requete= $this->db->prepare($commandeRequete);
            if($requete){
                $requete->execute();
            }
            $requete->closeCursor();
        }
        }


}