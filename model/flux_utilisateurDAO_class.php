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

    function getNomFlux_utilisateur(string $flux, string $login): Flux_utilisateur
    {
        //$login = $this->db->quote($login);
        $commandeRequete = "SELECT nom FROM flux_utilisateur WHERE flux= :flux AND login=:login";
        $requete = $this->db->prepare($commandeRequete);
        $requete->bindParam(':flux',$flux,PDO::PARAM_STR );
        $requete->bindParam(':login',$login,PDO::PARAM_STR);
        if ($requete) {
            $requete->execute();
            $resultat = $requete->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Flux_utilisateur");
            return $resultat[0];
        }
    }

    function getFlux_utilisateur(string $nom, string $login): Flux_utilisateur
    {
        //$login = $this->db->quote($login);
        //$nom = $this->db->quote($nom);
        $commandeRequete = "SELECT * FROM flux_utilisateur WHERE nom= :nom AND login= :login";
        $requete = $this->db->prepare($commandeRequete);
        $requete->bindParam(':nom',$nom,PDO::PARAM_STR );
        $requete->bindParam(':login',$login,PDO::PARAM_STR);
        if ($requete) {
            $requete->execute();
            $resultat = $requete->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Flux_utilisateur");
            return $resultat[0];
        }
    }

    function getFlux_utilisateurByLogin(string $login): array
    {
        //$login = $this->db->quote($login);
        $commandeRequete = "SELECT * FROM flux_utilisateur WHERE login= :login";
        $requete = $this->db->prepare($commandeRequete);
        $requete->bindParam(':login',$login,PDO::PARAM_STR);
        if ($requete) {
            $requete->execute();
            $resultat = $requete->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Flux_utilisateur");
            return $resultat;
        }
    }

    function getNombreFlux_utilisateur(): int
    {
        $commandeRequete = "SELECT COUNT(Distinct flux) FROM flux_utilisateurs";
        $requete = $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->execute();
            $resultat = $requete->fetch()['flux'];
            return $resultat;
        }
    }

    function isNomUtilise(string $login, string $nom): bool
    {
        //$login = $this->db->quote($login);
        $commandeRequete = "SELECT * FROM flux_utilisateur WHERE login= :login AND nom= :nom";
        $requete = $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->bindParam(':nom',$nom,PDO::PARAM_STR );
            $requete->bindParam(':login',$login,PDO::PARAM_STR);
            $requete->execute();
            $resultat = $requete->fetchAll();
            $requete->closeCursor();
            return count($resultat) > 0;
        }
        return false;
    }


    function isExistFlux_utilisateur(string $login, string $flux): bool
    {
        //$login = $this->db->quote($login);
        $commandeRequete = "SELECT * FROM flux_utilisateur WHERE flux= :flux AND login= :login";
        $requete = $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->bindParam(':flux',$flux,PDO::PARAM_STR );
            $requete->bindParam(':login',$login,PDO::PARAM_STR);
            $requete->execute();
            $resultat = $requete->fetchAll();
            $requete->closeCursor();
            return count($resultat) > 0;
        }
        return false;
    }

    function addFlux_utilisateur(Flux_utilisateur $flux_utilisateur) : bool
    {
        if ($this->isExistFlux_utilisateur($flux_utilisateur->getLogin(), $flux_utilisateur->getFlux())) {
            return false;
        }
        $login =$flux_utilisateur->getLogin();
        $nom = $flux_utilisateur->getNom();
        $categorie = $flux_utilisateur->getCategorie();
        $flux= $flux_utilisateur->getFlux();
        //$commandeRequete = 'INSERT INTO flux_utilisateur(flux, login, nom, categorie) VALUES(\'' . $flux_utilisateur->getFlux() . '\', ' . $login . ', ' . $nom . ', ' . $categorie . ')';
        $commandeRequete= 'INSERT INTO flux_utilisateur(flux, login, nom, categorie) VALUES( :flux , :login, :nom, :categorie)';
        $requete = $this->db->prepare($commandeRequete);
        if ($requete) {
            $requete->bindParam(':flux',$flux,PDO::PARAM_STR );
            $requete->bindParam(':login',$login,PDO::PARAM_STR);
            $requete->bindParam(':nom',$nom,PDO::PARAM_STR);
            $requete->bindParam(':categorie',$categorie,PDO::PARAM_STR);
            $requete->execute();
            $requete->closeCursor();
            return true;
        }
        return false;
    }

    function removeFlux_utilisateur(Flux_utilisateur $flux_utilisateur)
    {
        if ($this->isExistFlux_utilisateur($flux_utilisateur->getLogin(), $flux_utilisateur->getFlux())) {
            $fluxAdelete = $flux_utilisateur->getFlux();
            $commandeRequete = "DELETE FROM flux_utilisateur WHERE flux= :fluxAdelete";
            $requete = $this->db->prepare($commandeRequete);
            if ($requete) {
                $requete->bindParam(':fluxAdelete',$fluxAdelete,PDO::PARAM_STR);
                $requete->execute();
                $requete->closeCursor();
            }
        }
    }

    function removeFlux_utilisateurByFlux($flux,$login){
        if ($this->isExistFlux_utilisateur()) {
            $commandeRequete = "DELETE  FROM flux WHERE flux= :flux AND login= :login";
            $requete = $this->db->prepare($commandeRequete);
            $requete->bindParam(':flux',$flux,PDO::PARAM_STR );
            $requete->bindParam(':login',$login,PDO::PARAM_STR);
            if ($requete) {
                $requete->execute();
                $requete->closeCursor();
            }
        }
    }

    function getCategories($login): array
    {
        //$login = $this->db->quote($login);
        $commandeRequete = "SELECT DISTINCT categorie FROM flux_utilisateur WHERE login= :login ORDER BY categorie";
        $requete = $this->db->prepare($commandeRequete);
        $requete->bindParam(':login',$login,PDO::PARAM_STR);
        if ($requete) {
            $requete->execute();
            $resultat = $requete->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Flux_utilisateur");
            return $resultat;
        }
    }
    function getFlux_utilisateurByCategories($login,$categorie): array {
        //$login = $this->db->quote($login);
        $commandeRequete = "SELECT DISTINCT flux FROM flux_utilisateur WHERE login= :login AND categorie= :categorie";
        $requete = $this->db->prepare($commandeRequete);
        $requete->bindParam(':login',$login,PDO::PARAM_STR);
        $requete->bindParam(':categorie',$categorie,PDO::PARAM_STR);
        if ($requete) {
            $requete->execute();
            $resultat = $requete->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Flux_utilisateur");
            return $resultat;
        }
    }
}