<?php

namespace Acme\TyperBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
 use Doctrine\Common\Collections\ArrayCollection;

/**
 * Mecz
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Mecz
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="druzyna1", type="string", length=255)
     */
    private $druzyna1;

    /**
     * @var string
     *
     * @ORM\Column(name="druzyna2", type="string", length=255)
     */
    private $druzyna2;

    /**
     * @var int
     *
     * @ORM\Column(name="bramki1", type="integer")
     */
    private $bramki1;

    /**
     * @var int
     *
     * @ORM\Column(name="bramki2", type="integer")
     */
    private $bramki2;

    /**
     * @var string
     *
     * @ORM\Column(name="wyniktyp", type="string", length=2)
     */
    private $wyniktyp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime")
     */
    private $data;
    
    /**
     * @var int
     *
     * @ORM\Column(name="typ1", type="float")
     */
    private $typ1;
    
    /**
     * @var int
     *
     * @ORM\Column(name="typ1x", type="float")
     */
    private $typ1x;
    
    /**
     * @var int
     *
     * @ORM\Column(name="typ2", type="float")
     */
    private $typ2;
    
    /**
     * @var int
     *
     * @ORM\Column(name="typ2x", type="float")
     */
    private $typ2x;
    
    /**
     * @var int
     *
     * @ORM\Column(name="typx", type="float")
     */
    private $typx;
    
     /**
   
      * @ORM\OneToMany(targetEntity="Typy", mappedBy="meczid")
      */
     protected $meczid;

     public function __construct()
     {
         $this->products = new ArrayCollection();
     }
 


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
     * Set druzyna1
     *
     * @param string $druzyna1
     * @return Mecz
     */
    public function setDruzyna1($druzyna1)
    {
        $this->druzyna1 = $druzyna1;

        return $this;
    }

    /**
     * Get druzyna1
     *
     * @return string 
     */
    public function getDruzyna1()
    {
        return $this->druzyna1;
    }

    /**
     * Set druzyna2
     *
     * @param string $druzyna2
     * @return Mecz
     */
    public function setDruzyna2($druzyna2)
    {
        $this->druzyna2 = $druzyna2;

        return $this;
    }

    /**
     * Get druzyna2
     *
     * @return string 
     */
    public function getDruzyna2()
    {
        return $this->druzyna2;
    }

    /**
     * Set bramki1
     *
     * @param integer $bramki1
     * @return Mecz
     */
    public function setBramki1($bramki1)
    {
        $this->bramki1 = $bramki1;

        return $this;
    }

    /**
     * Get bramki1
     *
     * @return integer 
     */
    public function getBramki1()
    {
        return $this->bramki1;
    }

    /**
     * Set bramki2
     *
     * @param integer $bramki2
     * @return Mecz
     */
    public function setBramki2($bramki2)
    {
        $this->bramki2 = $bramki2;

        return $this;
    }

    /**
     * Get bramki2
     *
     * @return integer
     */
    public function getBramki2()
    {
        return $this->bramki2;
    }

    /**
     * Set wyniktyp
     *
     * @param string $wyniktyp
     * @return Mecz
     */
    public function setWyniktyp($wyniktyp)
    {
        $this->wyniktyp = $wyniktyp;

        return $this;
    }

    /**
     * Get wyniktyp
     *
     * @return string 
     */
    public function getWyniktyp()
    {
        return $this->wyniktyp;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     * @return Mecz
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime 
     */
    public function getData()
    {
        return $this->data;
    }
    
     /**
     * Set typ1
     *
     * @param float $typ1
     * @return Mecz
     */
    public function setTyp1($typ1)
    {
        $this->typ1 = $typ1;

        return $this;
    }

    /**
     * Get typ1
     *
     * @return float
     */
    public function getTyp1()
    {
        return $this->typ1;
    }
    
      /**
     * Set typ2
     *
     * @param float $typ2
     * @return Mecz
     */
    public function setTyp2($typ2)
    {
        $this->typ2 = $typ2;

        return $this;
    }

    /**
     * Get typ2
     *
     * @return float
     */
    public function getTyp2()
    {
        return $this->typ2;
    }
    
      /**
     * Set typ1x
     *
     * @param float $typ1x
     * @return Mecz
     */
    public function setTyp1x($typ1x)
    {
        $this->typ1x = $typ1x;

        return $this;
    }

    /**
     * Get typ1x
     *
     * @return float
     */
    public function getTyp1x()
    {
        return $this->typ1x;
    }
    
      /**
     * Set typ2x
     *
     * @param float $typ2x
     * @return Mecz
     */
    public function setTyp2x($typ2x)
    {
        $this->typ2x = $typ2x;

        return $this;
    }

    /**
     * Get typ2x
     *
     * @return float
     */
    public function getTyp2x()
    {
        return $this->typ2x;
    }
    
      /**
     * Set typx
     *
     * @param float $typx
     * @return Mecz
     */
    public function setTypx($typx)
    {
        $this->typx = $typx;

        return $this;
    }

    /**
     * Get typx
     *
     * @return float
     */
    public function getTypx()
    {
        return $this->typx;
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return Mecz
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Add meczid
     *
     * @param \Acme\TyperBundle\Entity\Typy $meczid
     * @return Mecz
     */
    public function addMeczid(\Acme\TyperBundle\Entity\Typy $meczid)
    {
        $this->meczid[] = $meczid;

        return $this;
    }

    /**
     * Remove meczid
     *
     * @param \Acme\TyperBundle\Entity\Typy $meczid
     */
    public function removeMeczid(\Acme\TyperBundle\Entity\Typy $meczid)
    {
        $this->meczid->removeElement($meczid);
    }

    /**
     * Get meczid
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMeczid()
    {
        return $this->meczid;
    }

    /**
     * Add mecz
     *
     * @param \Acme\TyperBundle\Entity\Typy $mecz
     * @return Mecz
     */
    public function addMecz(\Acme\TyperBundle\Entity\Typy $mecz)
    {
        $this->mecz[] = $mecz;

        return $this;
    }

    /**
     * Remove mecz
     *
     * @param \Acme\TyperBundle\Entity\Typy $mecz
     */
    public function removeMecz(\Acme\TyperBundle\Entity\Typy $mecz)
    {
        $this->mecz->removeElement($mecz);
    }

    /**
     * Get mecz
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMecz()
    {
        return $this->mecz;
    }

    /**
     * Add mecztyp
     *
     * @param \Acme\TyperBundle\Entity\Typy $mecztyp
     * @return Mecz
     */
    public function addMecztyp(\Acme\TyperBundle\Entity\Typy $mecztyp)
    {
        $this->mecztyp[] = $mecztyp;

        return $this;
    }

    /**
     * Remove mecztyp
     *
     * @param \Acme\TyperBundle\Entity\Typy $mecztyp
     */
    public function removeMecztyp(\Acme\TyperBundle\Entity\Typy $mecztyp)
    {
        $this->mecztyp->removeElement($mecztyp);
    }

    /**
     * Get mecztyp
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMecztyp()
    {
        return $this->mecztyp;
    }
}
