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

    function getUtilisateur(string $login): Utilisateur
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

    function isExistUtilisateur(string $login): bool
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

    function addUtilisateur(Utilisateur $utilisateur)
    {
        if ($this->isExistUtilisateur($utilisateur->getLogin())) {
            return;
        }
        $login = $this->db->quote($utilisateur->getLogin());
        $mp = $this->db->quote($utilisateur->getMp());
        $commandeRequete = 'INSERT INTO utilisateurs(login,mp) VALUES(\'' . $login . '\', ' . $mp . ')';
        $requete = $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->execute();
        }
        $requete->closeCursor();
    }
    function removeUtilisateur(Utilisateur $utilisateur){
        if ($this->isExistUtilisateur($utilisateur->getLogin())){
            $loginAdelete= $utilisateur->getLogin();
            $commandeRequete1="DELETE FROM flux_utilisateurs WHERE login=$loginAdelete";
            $requete1=$this->db->prepare($commandeRequete1);
            if($requete1){
                $requete1->execute();
            }
            $requete1->closeCursor();
            $commandeRequete2="DELETE FROM flux WHERE login=$loginAdelete";
            $requete2= $this->db->prepare($commandeRequete2);
            if($requete2){
                $requete2->execute();
            }
            $requete2->closeCursor();
        }
    }
}
