<?php


class Utilisateur
{
//attributs
private string $login;
private string $mp;

//constructeurs
    public function __construct(string $login, string $mp)
{
     $this->login=$login;
     $this->mp=$mp;
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
    public function getMp(): string
    {
        return $this->mp;
    }

    /**
     * @param string $mp
     */
    public function setMp(string $mp): void
    {
        $this->mp = $mp;
    }
}