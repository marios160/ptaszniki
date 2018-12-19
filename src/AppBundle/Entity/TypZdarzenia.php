<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypZdarzenia
 *
 * @ORM\Table(name="typ_zdarzenia")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypZdarzeniaRepository")
 */
class TypZdarzenia
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
     * @ORM\Column(name="nazwa", type="string", length=50)
     */
    private $nazwa;

    /**
     * @var string
     *
     * @ORM\Column(name="opis", type="text")
     */
    private $opis;

    /**
     * * @ORM\OneToMany(targetEntity="Zdarzenie", mappedBy="typZdarzenia")
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
     * @return TypZdarzenia
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
     * @return TypZdarzenia
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
     * Add zdarzenium
     *
     * @param \AppBundle\Entity\Zdarzenie $zdarzenium
     *
     * @return TypZdarzenia
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
