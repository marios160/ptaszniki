<?php


namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Description of Ptasznik
 *
 * @author Mateusz Błaszczak
 */

/**
  * @ORM\Table(name="ptaszniki")
  * @ORM\Entity(repositoryClass="AppBundle\Repository\PtasznikRepository")
  */
class Ptasznik {
    
    /**
      * @ORM\Column(type="integer")
      * @ORM\Id
      * @ORM\GeneratedValue(strategy="AUTO")
      */
    protected $id;
   
    
    /**
      * @ORM\Column(name="kod_ean", type="string", length=100,unique=true)
      * @Assert\NotBlank()
      */
    protected $kodEan;
     
     /**
      * @ORM\Column(name="nazwa_lacinska", type="string")
      * @Assert\NotBlank()
      */
     protected $nazwaLacinska;
     
     /**
      * @ORM\Column(name="lp_w_partii", type="integer")
      */
     protected $lpWPartii;
     
     /**
      * @ORM\Column(name="uwagi", type="string", length=255)
      */
     protected $uwagi;
     
     /**
      * @ORM\Column(name="nazwa_polska", type="string", length=50)
      */
     protected $nazwaPolska;
     
     /**
      * @ORM\ManyToOne(targetEntity="Magazyn", inversedBy="ptaszniki")
      * @ORM\JoinColumn(name="magazyn_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
      */
     protected $magazyn;
     
     /**
      * @ORM\ManyToOne(targetEntity="Terrarium", inversedBy="ptaszniki")
      * @ORM\JoinColumn(name="terrarium_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
      */
     protected $terrarium;
     
     /**
      * @ORM\Column(name="kod_dostawy", type="string", length=20)
      */
     protected $kodDostawy;
     
     /**
      * @ORM\Column(name="zakup_rozmiar", type="string", length=10)
      */
     protected $zakupRozmiar;
     
     /**
      * @ORM\Column(name="plec", type="string", length=20)
      */
     protected $plec;
     
     /**
      * @ORM\Column(name="aktualny_rozmiar", type="string", length=20)
      */
     protected $aktualnyRozmiar;
     
     /**
      * @ORM\Column(name="wydruk_etykiety", type="boolean")
      */
     protected $wydrukEtykiety;
     
     /**
     * * @ORM\OneToMany(targetEntity="Zdarzenie", mappedBy="ptasznik")
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
     * Set kodEan
     *
     * @param string $kodEan
     *
     * @return Ptasznik
     */
    public function setKodEan($kodEan)
    {
        $this->kodEan = $kodEan;

        return $this;
    }

    /**
     * Get kodEan
     *
     * @return string
     */
    public function getKodEan()
    {
        return $this->kodEan;
    }

    /**
     * Set nazwaLacinska
     *
     * @param integer $nazwaLacinska
     *
     * @return Ptasznik
     */
    public function setNazwaLacinska($nazwaLacinska)
    {
        $this->nazwaLacinska = $nazwaLacinska;

        return $this;
    }

    /**
     * Get nazwaLacinska
     *
     * @return integer
     */
    public function getNazwaLacinska()
    {
        return $this->nazwaLacinska;
    }

    /**
     * Set lpWPartii
     *
     * @param string $lpWPartii
     *
     * @return Ptasznik
     */
    public function setLpWPartii($lpWPartii)
    {
        $this->lpWPartii = $lpWPartii;

        return $this;
    }

    /**
     * Get lpWPartii
     *
     * @return string
     */
    public function getLpWPartii()
    {
        return $this->lpWPartii;
    }

    /**
     * Set uwagi
     *
     * @param string $uwagi
     *
     * @return Ptasznik
     */
    public function setUwagi($uwagi)
    {
        $this->uwagi = $uwagi;

        return $this;
    }

    /**
     * Get uwagi
     *
     * @return string
     */
    public function getUwagi()
    {
        return $this->uwagi;
    }

    /**
     * Set nazwaPolska
     *
     * @param string $nazwaPolska
     *
     * @return Ptasznik
     */
    public function setNazwaPolska($nazwaPolska)
    {
        $this->nazwaPolska = $nazwaPolska;

        return $this;
    }

    /**
     * Get nazwaPolska
     *
     * @return string
     */
    public function getNazwaPolska()
    {
        return $this->nazwaPolska;
    }

    /**
     * Set kodDostawy
     *
     * @param string $kodDostawy
     *
     * @return Ptasznik
     */
    public function setKodDostawy($kodDostawy)
    {
        $this->kodDostawy = $kodDostawy;

        return $this;
    }

    /**
     * Get kodDostawy
     *
     * @return string
     */
    public function getKodDostawy()
    {
        return $this->kodDostawy;
    }

    /**
     * Set zakupRozmiar
     *
     * @param string $zakupRozmiar
     *
     * @return Ptasznik
     */
    public function setZakupRozmiar($zakupRozmiar)
    {
        $this->zakupRozmiar = $zakupRozmiar;

        return $this;
    }

    /**
     * Get zakupRozmiar
     *
     * @return string
     */
    public function getZakupRozmiar()
    {
        return $this->zakupRozmiar;
    }

    /**
     * Set plec
     *
     * @param string $plec
     *
     * @return Ptasznik
     */
    public function setPlec($plec)
    {
        $this->plec = $plec;

        return $this;
    }

    /**
     * Get plec
     *
     * @return string
     */
    public function getPlec()
    {
        return $this->plec;
    }

    /**
     * Set aktualnyRozmiar
     *
     * @param string $aktualnyRozmiar
     *
     * @return Ptasznik
     */
    public function setAktualnyRozmiar($aktualnyRozmiar)
    {
        $this->aktualnyRozmiar = $aktualnyRozmiar;

        return $this;
    }

    /**
     * Get aktualnyRozmiar
     *
     * @return string
     */
    public function getAktualnyRozmiar()
    {
        return $this->aktualnyRozmiar;
    }

    /**
     * Set wydrukEtykiety
     *
     * @param boolean $wydrukEtykiety
     *
     * @return Ptasznik
     */
    public function setWydrukEtykiety($wydrukEtykiety)
    {
        $this->wydrukEtykiety = $wydrukEtykiety;

        return $this;
    }

    /**
     * Get wydrukEtykiety
     *
     * @return boolean
     */
    public function getWydrukEtykiety()
    {
        return $this->wydrukEtykiety;
    }

    /**
     * Set magazyn
     *
     * @param \AppBundle\Entity\Magazyn $magazyn
     *
     * @return Ptasznik
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
     * Set terrarium
     *
     * @param \AppBundle\Entity\Terrarium $terrarium
     *
     * @return Ptasznik
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

    /**
     * Add zdarzenium
     *
     * @param \AppBundle\Entity\Zdarzenie $zdarzenium
     *
     * @return Ptasznik
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
