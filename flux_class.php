<?php


class Flux
{
private string $url;

    /**
     * Flux constructor.
     */
    function __construct(string $url){
        $this->url= $url;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }


}