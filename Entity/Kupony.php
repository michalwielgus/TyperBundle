<?php

namespace Acme\TyperBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kupony
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Kupony
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_uzytkownika", type="integer")
     */
    private $id_uzytkownika;

    /**
     * @var float
     *
     * @ORM\Column(name="stawka", type="float")
     */
    private $stawka;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=20)
     */
    private $status;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id_uzytkownika
     *
     * @param integer $idUzytkownika
     * @return Kupony
     */
    public function setIdUzytkownika($idUzytkownika)
    {
        $this->id_uzytkownika = $idUzytkownika;

        return $this;
    }

    /**
     * Get id_uzytkownika
     *
     * @return integer 
     */
    public function getIdUzytkownika()
    {
        return $this->id_uzytkownika;
    }

    /**
     * Set stawka
     *
     * @param float $stawka
     * @return Kupony
     */
    public function setStawka($stawka)
    {
        $this->stawka = $stawka;

        return $this;
    }

    /**
     * Get stawka
     *
     * @return float 
     */
    public function getStawka()
    {
        return $this->stawka;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Kupony
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
