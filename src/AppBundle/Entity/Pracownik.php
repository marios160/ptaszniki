<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Description of Pracownik
 *
 * @author Mateusz Błaszczak
 */

/**
  * @ORM\Entity
  * @ORM\Table(name="pracownicy")
  */
class Pracownik{
    
    /**
      * @ORM\Column(type="integer")
      * @ORM\Id
      * @ORM\GeneratedValue(strategy="AUTO")
      */
    protected $id;
    
    /**
      * @ORM\Column(type="string", length=50)
      */
    protected $nazwisko;
    
    /**
      * @ORM\Column(type="string", length=50)
      */
    protected $imie;
    /**
      * @ORM\Column(type="string", length=9, nullable=true)
      */
    protected $nrTelefonu;
    /**
      * @ORM\Column(type="string", length=30, nullable=true)
      */
    protected $email;
    /**
      * @ORM\Column(type="string", length=50, nullable=true)
      */
    protected $stanowisko;
    
    /**
     * * @ORM\OneToMany(targetEntity="Zdarzenie", mappedBy="pracownik")
     */
    protected $zdarzenia;
    
     public function __construct()
     {
         $this->zdarzenia = new ArrayCollection();
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
     * Set nazwisko
     *
     * @param string $nazwisko
     *
     * @return Pracownik
     */
    public function setNazwisko($nazwisko)
    {
        $this->nazwisko = $nazwisko;

        return $this;
    }

    /**
     * Get nazwisko
     *
     * @return string
     */
    public function getNazwisko()
    {
        return $this->nazwisko;
    }

    /**
     * Set imie
     *
     * @param string $imie
     *
     * @return Pracownik
     */
    public function setImie($imie)
    {
        $this->imie = $imie;

        return $this;
    }

    /**
     * Get imie
     *
     * @return string
     */
    public function getImie()
    {
        return $this->imie;
    }

    /**
     * Set nrTelefonu
     *
     * @param string $nrTelefonu
     *
     * @return Pracownik
     */
    public function setNrTelefonu($nrTelefonu)
    {
        $this->nrTelefonu = $nrTelefonu;

        return $this;
    }

    /**
     * Get nrTelefonu
     *
     * @return string
     */
    public function getNrTelefonu()
    {
        return $this->nrTelefonu;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Pracownik
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set stanowisko
     *
     * @param string $stanowisko
     *
     * @return Pracownik
     */
    public function setStanowisko($stanowisko)
    {
        $this->stanowisko = $stanowisko;

        return $this;
    }

    /**
     * Get stanowisko
     *
     * @return string
     */
    public function getStanowisko()
    {
        return $this->stanowisko;
    }

    /**
     * Add zdarzenium
     *
     * @param \AppBundle\Entity\Zdarzenie $zdarzenium
     *
     * @return Pracownik
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
