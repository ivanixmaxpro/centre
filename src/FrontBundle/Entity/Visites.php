<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Visites
 *
 * @ORM\Table(name="visites", indexes={@ORM\Index(name="id", columns={"id"}), @ORM\Index(name="tractaments_fk", columns={"tractaments_fk"}), @ORM\Index(name="pacients_fk", columns={"pacients_fk"}), @ORM\Index(name="metges_fk", columns={"metges_fk"})})
 * @ORM\Entity
 */
class Visites
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date", nullable=false)
     */
    private $data;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \FrontBundle\Entity\Tractaments
     *
     * @ORM\ManyToOne(targetEntity="FrontBundle\Entity\Tractaments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tractaments_fk", referencedColumnName="id")
     * })
     */
    private $tractamentsFk;

    /**
     * @var \FrontBundle\Entity\Pacients
     *
     * @ORM\ManyToOne(targetEntity="FrontBundle\Entity\Pacients")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pacients_fk", referencedColumnName="dni")
     * })
     */
    private $pacientsFk;

    /**
     * @var \FrontBundle\Entity\Metges
     *
     * @ORM\ManyToOne(targetEntity="FrontBundle\Entity\Metges")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="metges_fk", referencedColumnName="dni")
     * })
     */
    private $metgesFk;



    /**
     * Set data
     *
     * @param \DateTime $data
     *
     * @return Visites
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tractamentsFk
     *
     * @param \FrontBundle\Entity\Tractaments $tractamentsFk
     *
     * @return Visites
     */
    public function setTractamentsFk(\FrontBundle\Entity\Tractaments $tractamentsFk = null)
    {
        $this->tractamentsFk = $tractamentsFk;

        return $this;
    }

    /**
     * Get tractamentsFk
     *
     * @return \FrontBundle\Entity\Tractaments
     */
    public function getTractamentsFk()
    {
        return $this->tractamentsFk;
    }

    /**
     * Set pacientsFk
     *
     * @param \FrontBundle\Entity\Pacients $pacientsFk
     *
     * @return Visites
     */
    public function setPacientsFk(\FrontBundle\Entity\Pacients $pacientsFk = null)
    {
        $this->pacientsFk = $pacientsFk;

        return $this;
    }

    /**
     * Get pacientsFk
     *
     * @return \FrontBundle\Entity\Pacients
     */
    public function getPacientsFk()
    {
        return $this->pacientsFk;
    }

    /**
     * Set metgesFk
     *
     * @param \FrontBundle\Entity\Metges $metgesFk
     *
     * @return Visites
     */
    public function setMetgesFk(\FrontBundle\Entity\Metges $metgesFk = null)
    {
        $this->metgesFk = $metgesFk;

        return $this;
    }

    /**
     * Get metgesFk
     *
     * @return \FrontBundle\Entity\Metges
     */
    public function getMetgesFk()
    {
        return $this->metgesFk;
    }
}
