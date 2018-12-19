<?php


namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Description of Zdarzenie
 *
 * @author Mateusz Błaszczak
 */

/**
  * @ORM\Entity(repositoryClass="AppBundle\Repository\ZdarzenieRepository")
  * @ORM\Table(name="zdarzenia")
  */
class Zdarzenie {
    
    /**
      * @ORM\Column(type="integer")
      * @ORM\Id
      * @ORM\GeneratedValue(strategy="AUTO")
      */
    protected $id;
    
    /**
      * @ORM\ManyToOne(targetEntity="TypZdarzenia", inversedBy="zdarzenia")
      * @ORM\JoinColumn(name="typ_zdarzenia_id", referencedColumnName="id")
      * @Assert\NotBlank()
      */
     protected $typZdarzenia;
     
     /**
      * @Assert\NotBlank()
      * @ORM\ManyToOne(targetEntity="Pracownik", inversedBy="zdarzenia")
      * @ORM\JoinColumn(name="pracownik_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
      */
     protected $pracownik;
     
     /**
      * @Assert\NotBlank()
      * @ORM\ManyToOne(targetEntity="Ptasznik", inversedBy="zdarzenia")
      * @ORM\JoinColumn(name="ptasznik_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
      */
     protected $ptasznik;
     
     /**
      * @ORM\Column(name="data", type="date")
      * @Assert\NotBlank()
      */
    protected $data;
     
    /**
     * @Assert\NotBlank()
      * @ORM\Column(name="opis", type="string", length=255, nullable=true)
      */
    protected $opis;
    
    /**
      * @ORM\Column(name="rozmiar", type="string", length=100, nullable=true)
      */
    protected $rozmiar;
    /**
      * @ORM\ManyToOne(targetEntity="Magazyn", inversedBy="zdarzenia")
      * @ORM\JoinColumn(name="magazyn_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
      */
     protected $magazyn;
    /**
      * @ORM\ManyToOne(targetEntity="Karma", inversedBy="zdarzenia")
      * @ORM\JoinColumn(name="karma_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
      */
     protected $karma;
    /**
      * @ORM\ManyToOne(targetEntity="Terrarium", inversedBy="zdarzenia")
      * @ORM\JoinColumn(name="terrarium_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
      */
     protected $terrarium;
     
    
    
    
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
     * Set typZdarzenia
     *
     * @param \AppBundle\Entity\TypZdarzenia $typZdarzenia
     *
     * @return Zdarzenie
     */
    public function setTypZdarzenia(\AppBundle\Entity\TypZdarzenia $typZdarzenia = null)
    {
        $this->typZdarzenia = $typZdarzenia;

        return $this;
    }

    /**
     * Get typZdarzenia
     *
     * @return \AppBundle\Entity\TypZdarzenia
     */
    public function getTypZdarzenia()
    {
        return $this->typZdarzenia;
    }

    /**
     * Set pracownik
     *
     * @param \AppBundle\Entity\Pracownik $pracownik
     *
     * @return Zdarzenie
     */
    public function setPracownik(\AppBundle\Entity\Pracownik $pracownik = null)
    {
        $this->pracownik = $pracownik;

        return $this;
    }

    /**
     * Get pracownik
     *
     * @return \AppBundle\Entity\Pracownik
     */
    public function getPracownik()
    {
        return $this->pracownik;
    }

    /**
     * Set ptasznik
     *
     * @param \AppBundle\Entity\Ptasznik $ptasznik
     *
     * @return Zdarzenie
     */
    public function setPtasznik(\AppBundle\Entity\Ptasznik $ptasznik = null)
    {
        $this->ptasznik = $ptasznik;

        return $this;
    }

    /**
     * Get ptasznik
     *
     * @return \AppBundle\Entity\Ptasznik
     */
    public function getPtasznik()
    {
        return $this->ptasznik;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     *
     * @return Zdarzenie
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
     * Set opis
     *
     * @param string $opis
     *
     * @return Zdarzenie
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
     * Set rozmiar
     *
     * @param string $rozmiar
     *
     * @return Zdarzenie
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
     * Set magazyn
     *
     * @param \AppBundle\Entity\Magazyn $magazyn
     *
     * @return Zdarzenie
     */
    public function setMagazyn(\AppBundle\Entity\Magazyn $magazyn = null)
    {
        $this->magazyn = $magazyn;

        return $this;
    }

    /**
     * Get magazyn
     *
     * @return \AppBundle\Entity\Magazyn
     */
    public function getMagazyn()
    {
        return $this->magazyn;
    }

    /**
     * Set karma
     *
     * @param \AppBundle\Entity\Karma $karma
     *
     * @return Zdarzenie
     */
    public function setKarma(\AppBundle\Entity\Karma $karma = null)
    {
        $this->karma = $karma;

        return $this;
    }

    /**
     * Get karma
     *
     * @return \AppBundle\Entity\Karma
     */
    public function getKarma()
    {
        return $this->karma;
    }

    /**
     * Set terrarium
     *
     * @param \AppBundle\Entity\Terrarium $terrarium
     *
     * @return Zdarzenie
     */
    public function setTerrarium(\AppBundle\Entity\Terrarium $terrarium = null)
    {
        $this->terrarium = $terrarium;

        return $this;
    }

    /**
     * Get terrarium
     *
     * @return \AppBundle\Entity\Terrarium
     */
    public function getTerrarium()
    {
        return $this->terrarium;
    }
}
