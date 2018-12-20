<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Dostawa
 *
 * @author Mateusz Błaszczak
 */

/**
 * Dostawa
 *
 * @ORM\Table(name="dostawa")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DostawaRepository")
 */
class Dostawa
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
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date")
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="faktura", type="string", length=30)
     */
    private $faktura;
    /**
     * @var string
     *
     * @ORM\Column(name="kod", type="string", length=30)
     */
    private $kod;


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
     * Set data
     *
     * @param \DateTime $data
     *
     * @return Dostawa
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
     * Set faktura
     *
     * @param string $faktura
     *
     * @return Dostawa
     */
    public function setFaktura($faktura)
    {
        $this->faktura = $faktura;

        return $this;
    }

    /**
     * Get faktura
     *
     * @return string
     */
    public function getFaktura()
    {
        return $this->faktura;
    }

    /**
     * Set kod
     *
     * @param string $kod
     *
     * @return Dostawa
     */
    public function setKod($kod)
    {
        $this->kod = $kod;

        return $this;
    }

    /**
     * Get kod
     *
     * @return string
     */
    public function getKod()
    {
        return $this->kod;
    }
}
