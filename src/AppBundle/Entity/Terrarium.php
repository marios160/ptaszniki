<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Terrarium
 *
 * @ORM\Table(name="terraria")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TerrariumRepository")
 */
class Terrarium
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nazwa", type="string", length=30 )
     */
    private $nazwa;

    /**
     * @var string
     *
     * @ORM\Column(name="opis", type="string", length=255, nullable=true)
     */
    private $opis;

    /**
     * @var string
     *
     * @ORM\Column(name="pojemnosc", type="string", length=20, nullable=true)
     */
    private $pojemnosc;

    /**
     * @var string
     *
     * @ORM\Column(name="rozmiar", type="string", length=20, nullable=true)
     */
    private $rozmiar;

    /**
     * * @ORM\OneToMany(targetEntity="Ptasznik", mappedBy="terrrarium")
     */
    protected $ptaszniki;
    
    /**
     * * @ORM\OneToMany(targetEntity="Zdarzenie", mappedBy="terrarium")
     */
    protected $zdarzenia;

    
     public function __construct()
     {
         $this->zdarzenia = new ArrayCollection();
         $this->terraria = new ArrayCollection();
     }
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nazwa
     *
     * @param string $nazwa
     *
     * @return Terrarium
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    /**
     * Get nazwa
     *
     * @return string
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }

    /**
     * Set opis
     *
     * @param string $opis
     *
     * @return Terrarium
     */
    public function setOpis($opis)
    {
        $this->opis = $opis;

        return $this;
    }

    /**
     * Get opis
     *
     * @return string
     */
    public function getOpis()
    {
        return $this->opis;
    }

    /**
     * Set pojemnosc
     *
     * @param string $pojemnosc
     *
     * @return Terrarium
     */
    public function setPojemnosc($pojemnosc)
    {
        $this->pojemnosc = $pojemnosc;

        return $this;
    }

    /**
     * Get pojemnosc
     *
     * @return string
     */
    public function getPojemnosc()
    {
        return $this->pojemnosc;
    }

    /**
     * Set rozmiar
     *
     * @param string $rozmiar
     *
     * @return Terrarium
     */
    public function setRozmiar($rozmiar)
    {
        $this->rozmiar = $rozmiar;

        return $this;
    }

    /**
     * Get rozmiar
     *
     * @return string
     */
    public function getRozmiar()
    {
        return $this->rozmiar;
    }

    /**
     * Add ptaszniki
     *
     * @param \AppBundle\Entity\Ptasznik $ptaszniki
     *
     * @return Terrarium
     */
    public function addPtaszniki(\AppBundle\Entity\Ptasznik $ptaszniki)
    {
        $this->ptaszniki[] = $ptaszniki;

        return $this;
    }

    /**
     * Remove ptaszniki
     *
     * @param \AppBundle\Entity\Ptasznik $ptaszniki
     */
    public function removePtaszniki(\AppBundle\Entity\Ptasznik $ptaszniki)
    {
        $this->ptaszniki->removeElement($ptaszniki);
    }

    /**
     * Get ptaszniki
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPtaszniki()
    {
        return $this->ptaszniki;
    }

    /**
     * Add zdarzenium
     *
     * @param \AppBundle\Entity\Zdarzenie $zdarzenium
     *
     * @return Terrarium
     */
    public function addZdarzenium(\AppBundle\Entity\Zdarzenie $zdarzenium)
    {
        $this->zdarzenia[] = $zdarzenium;

        return $this;
    }

    /**
     * Remove zdarzenium
     *
     * @param \AppBundle\Entity\Zdarzenie $zdarzenium
     */
    public function removeZdarzenium(\AppBundle\Entity\Zdarzenie $zdarzenium)
    {
        $this->zdarzenia->removeElement($zdarzenium);
    }

    /**
     * Get zdarzenia
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getZdarzenia()
    {
        return $this->zdarzenia;
    }
}
