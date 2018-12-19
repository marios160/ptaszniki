<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Karma
 *
 * @ORM\Table(name="karmy")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\KarmaRepository")
 */
class Karma
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
     * @ORM\Column(name="nazwa", type="string", length=30)
     */
    private $nazwa;

    /**
     * @var string
     *
     * @ORM\Column(name="opis", type="string", length=255, nullable=true)
     */
    private $opis;

    /**
     * @var int
     *
     * @ORM\Column(name="waga", type="integer", nullable=true)
     */
    private $waga;

    /**
     * @var int
     *
     * @ORM\Column(name="ilosc", type="integer", nullable=true)
     */
    private $ilosc;

    
    /**
     * * @ORM\OneToMany(targetEntity="Zdarzenie", mappedBy="karma")
     */
    protected $zdarzenia;
    
    public function __construct()
     {
         $this->zdarzenia = new ArrayCollection();
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
     * @return Karma
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
     * @return Karma
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
     * Set waga
     *
     * @param integer $waga
     *
     * @return Karma
     */
    public function setWaga($waga)
    {
        $this->waga = $waga;

        return $this;
    }

    /**
     * Get waga
     *
     * @return int
     */
    public function getWaga()
    {
        return $this->waga;
    }

    /**
     * Set ilosc
     *
     * @param integer $ilosc
     *
     * @return Karma
     */
    public function setIlosc($ilosc)
    {
        $this->ilosc = $ilosc;

        return $this;
    }

    /**
     * Get ilosc
     *
     * @return int
     */
    public function getIlosc()
    {
        return $this->ilosc;
    }

    /**
     * Add zdarzenium
     *
     * @param \AppBundle\Entity\Zdarzenie $zdarzenium
     *
     * @return Karma
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
