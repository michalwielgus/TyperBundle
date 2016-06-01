<?php

namespace Acme\TyperBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Typy
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Typy
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
     * @ORM\Column(name="id_kuponu", type="integer")
     */
    private $id_kuponu;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="id_meczu", type="integer")
     */
    private $id_meczu;

 

    /**
     * @var string
     *
     * @ORM\Column(name="typ", type="string", length=2)
    
     */
    private $typ;
    
     /**
     * @var int
     *
     * @ORM\Column(name="stawka", type="float")
     */
    private $stawka;
    
      /**
      * @ORM\ManyToOne(targetEntity="Mecz", inversedBy="meczid",cascade={"persist"})
      * @ORM\JoinColumn(name="id_meczu", referencedColumnName="id")
      */
    private $meczid;
    



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
     * Set id_kuponu
     *
     * @param integer $idKuponu
     * @return Typy
     */
    public function setIdKuponu($idKuponu)
    {
        $this->id_kuponu = $idKuponu;

        return $this;
    }

    /**
     * Get id_kuponu
     *
     * @return integer 
     */
    public function getIdKuponu()
    {
        return $this->id_kuponu;
    }

    /**
     * Set id_meczu
     *
     * @param integer $idMeczu
     * @return Typy
     */
    public function setIdMeczu($idMeczu)
    {
        $this->id_meczu = $idMeczu;

        return $this;
    }

    /**
     * Get id_meczu
     *
     * @return integer 
     */
    public function getIdMeczu()
    {
        return $this->id_meczu;
    }

    /**
     * Set typ
     *
     * @param string $typ
     * @return Typy
     */
    public function setTyp($typ)
    {
        $this->typ = $typ;

        return $this;
    }

    /**
     * Get typ
     *
     * @return string 
     */
    public function getTyp()
    {
        return $this->typ;
    }

    /**
     * Set meczid
     *
     * @param \Acme\TyperBundle\Entity\Mecz $meczid
     * @return Typy
     */
    public function setMeczid(\Acme\TyperBundle\Entity\Mecz $meczid = null)
    {
        $this->meczid = $meczid;

        return $this;
    }

    /**
     * Get meczid
     *
     * @return \Acme\TyperBundle\Entity\Mecz 
     */
    public function getMeczid()
    {
        return $this->meczid;
    }

    /**
     * Set stawka
     *
     * @param float $stawka
     * @return Typy
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
}
