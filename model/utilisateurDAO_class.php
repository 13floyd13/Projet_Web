<?php
require_once(dirname(__FILE__).'/utilisateur_class.php');


class UtilisateurDAO
{
    //attributs
    private PDO $db;

    //constructeurs
    function __construct()
    {
        $database = 'sqlite:' . dirname(__FILE__) . '/../data/newsDB'; // Data source name
        try {
            $db = new PDO($database);
        } catch (PDOException $e) {
            die ("Erreur : " . $e->getMessage());
        }
    }

    function getUtilisateur($login): Utilisateur
    {
        $login = $this->db->quote($login);
        $commandeRequete = "SELECT * FROM utilisateurs WHERE login=$login";
        $requete = $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->execute();
        }
        $resultat = $requete->fetchAll(PDO::FETCH_CLASS, "Utilisateur");
        return $resultat[0];
    }

    function getNombreUtilisateurs()
    {
        $commandeRequete = "SELECT COUNT(Distinct login) FROM utilisateurs";
        $requete = $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->execute();
        }
        $resultat = $requete->fetch()['login'];
        return $resultat;
    }

    function isExistUtilisateur($login): bool
    {
        $login = $this->db->quote($login);
        $commandeRequete = "SELECT * FROM utilisateurs WHERE login= $login";
        $requete = $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->execute();
        }
        $resultat = $requete->fetchAll();
        $requete->closeCursor();
        return count($resultat) > 0;
    }

    function addUtilisateur($utilisateur)
    {
        if ($this->isExistUtilisateur($utilisateur->login)) {
            return;
        }
        $login = $this->db->quote($utilisateur->login);
        $mp = $this->db->quote($utilisateur->mp);
        $commandeRequete = 'INSERT INTO utilisateurs(login,mp) VALUES(\'' . $login . '\', ' . $mp . ')';
        $requete = $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->execute();
        }
        $requete->closeCursor();
    }
}
