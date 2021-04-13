<?php

class Nouvelle
{
//attributs
private int $id;
private string $date;
private string $titre;
private string $description;
private string $lien;
private string $image;
private string $flux;

//constructeurs
public function __construct(int $id,string $date, string $titre, string $description, string $lien, string $image, string $flux)
{
    $this->id=$id;
    $this->date=$date;
    $this->titre=$titre;
    $this->description=$description;
    $this->lien=$lien;
    $this->image=$image;
    $this->flux=$flux;
}
//méthodes
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }
    /**
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }
    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
    /**
     * @return string
     */
    public function getLien(): string
    {
        return $this->lien;
    }
    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }
    /**
     * @return string
     */
    public function getFlux(): string
    {
        return $this->flux;
    }


}