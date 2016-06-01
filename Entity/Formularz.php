<?php
namespace Acme\TyperBundle\Entity;

class Formularz
{
    protected $kwota;

    

    public function getKwota()
    {
        return $this->kwota;
    }
    public function setKwota($kwota)
    {
        $this->kwota = $kwota;
    }

}