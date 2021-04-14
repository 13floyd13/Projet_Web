<?php
class Flux_utilisateur
{
//attributs
private string $flux;
private string $login;
private string $nom;
private string $categorie;

//constructeur
    public function __construct(string $flux, string $login, string $nom,string $categorie){
        $this->flux=$flux;
        $this->login=$login;
        $this->nom=$nom;
        $this->categorie=$categorie;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getFlux(): string
    {
        return $this->flux;
    }

    /**
     * @return string
     */
    public function getCategorie(): string
    {
        return $this->categorie;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $categorie
     */
    public function setCategorie(string $categorie): void
    {
        $this->categorie = $categorie;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }
}