<?php
require_once fluxDAO_class.php;
/*
function afficherTitres($url)
    {
        $sql= "SELECT titre, id , flux
                FROM flux, nouvelles
                WHERE $url =url AND flux.url=nouvelles.flux
                ORDER BY id";
        $flux= $this->db->query($sql);
        $result=$flux->fetchall(PDO::FETCH_CLASS);
        return $result[0];

    }
