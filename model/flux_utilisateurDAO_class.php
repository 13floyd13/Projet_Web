<?php
require_once(dirname(__FILE__).'/flux_utilisateurDAO_class.php');

class Flux_utilisateurDAO
{
    private PDO $db;

    function __construct()
    {
        $database = 'sqlite:' . dirname(__FILE__) . '/../data/newsDB'; // Data source name
        try {
            $db = new PDO($database);
        } catch (PDOException $e) {
            die ("Erreur : " . $e->getMessage());
        }
    }

    function getNomFlux_utilisateur($flux, $login): Flux_utilisateur
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

    function getFlux_utilisateur($nom, $login): Flux_utilisateur
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

    function isExistFlux_utilisateur($login, $flux): bool
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
    function addFlux_utilisateur($flux_utilisateur){
        if($this->isExistFlux_utilisateur()){
            return;
        }
        $login = $this->db->quote($flux_utilisateur->login);
        $nom = $this->db->quote($flux_utilisateur->nom);
        $categorie = $this->db->quote($flux_utilisateur->categorie);
        $commandeRequete = 'INSERT INTO nouvelles(flux, login, nom, categorie) VALUES(\'' . $flux_utilisateur->flux . '\', ' . $login . ', ' . $nom . ', ' . $categorie . ')';
        $requete = $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->execute();
        }
        $requete->closeCursor();
    }
}