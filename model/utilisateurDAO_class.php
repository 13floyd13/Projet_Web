<?php
require_once("../model/utilisateur_class.php");


class UtilisateurDAO
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

    function getUtilisateur(string $login): Utilisateur
    {
        //$login = $this->db->quote($login);
        $commandeRequete = "SELECT * FROM utilisateurs WHERE login= :login";
        $requete = $this->db->prepare($commandeRequete);
        $requete->bindParam(':login',$login,PDO::PARAM_STR);
        if ($requete) {
            $requete->execute();
            $resultat = $requete->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Utilisateur");
            return $resultat[0];
        }
    }

    function getUtilisateurs(): array {
        $commandeRequete="SELECT * FROM utilisateurs";
        $requete=$this->db->prepare($commandeRequete);
        if ($requete){
            $requete->execute();
            $resultat= $requete->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,"Utilisateur");
            return $resultat;
        }
    }

    function getNombreUtilisateurs()
    {
        $commandeRequete = "SELECT COUNT(Distinct login) FROM utilisateurs";
        $requete = $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->execute();
            $resultat = $requete->fetch()['login'];
            return $resultat;
        }
    }

    function isExistUtilisateur(string $login): bool
    {
        $requete = $this->db->prepare('SELECT * FROM utilisateurs WHERE login= :login');

        if ($requete) {
            //$login = $this->db->quote($login);
            $requete->BindParam(':login',$login);
            $requete->execute();
            $resultat = $requete->fetchAll();
            print_r($resultat);
            print_r(count($resultat));
            $requete->closeCursor();
            return count($resultat) > 0;
        }
    }

    function addUtilisateur(Utilisateur $utilisateur)
    {
        if ($this->isExistUtilisateur($utilisateur->getLogin())) {
            return;
        }
        $login = $this->db->quote($utilisateur->getLogin());
        $mp = $this->db->quote($utilisateur->getMp());
        $commandeRequete = 'INSERT INTO utilisateurs(login,mp) VALUES( :login, :mp)';
        $requete = $this->db->prepare($commandeRequete);
        $requete->bindParam(':login',$login,PDO::PARAM_STR);
        $requete->bindParam(':mp',$mp,PDO::PARAM_STR);
        if ($requete) {
            $requete->execute();
            $requete->closeCursor();
        }
    }

    function removeUtilisateur(Utilisateur $utilisateur){
        if ($this->isExistUtilisateur($utilisateur->getLogin())){
            $loginAdelete= $utilisateur->getLogin();
            $commandeRequete1="DELETE FROM flux_utilisateurs WHERE login= :loginAdelete";
            $requete1=$this->db->prepare($commandeRequete1);
            $requete1->bindParam(':loginAdelete',$loginAdelete,PDO::PARAM_STR);
            if($requete1){
                $requete1->execute();
            }
            $requete1->closeCursor();
            $commandeRequete2="DELETE FROM flux WHERE login= :loginAdelete";
            $requete2= $this->db->prepare($commandeRequete2);
            $requete2->bindParam(':loginAdelete',$loginAdelete,PDO::PARAM_STR);
            if($requete2){
                $requete2->execute();
            }
            $requete2->closeCursor();
        }
    }

    function updateUtilisateur(Utilisateur $utilisateur, string $new_mp){
      try {
        $login = $utilisateur->getLogin();
        $commandeRequete = "UPDATE utilisateurs SET mp = '$new_mp' WHERE login = '$login'";
        $requete=$this->db->prepare($commandeRequete);
        if ($requete) {
          $requete->execute();
        }
        $requete->closeCursor();
      } catch (PDOException $e) {
          echo 'ERROR UPDATING CONTENT : '.$e->getMessage();
      }
    }


}
