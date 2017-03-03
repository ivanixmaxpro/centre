<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pacients
 *
 * @ORM\Table(name="pacients", indexes={@ORM\Index(name="dni", columns={"dni"})})
 * @ORM\Entity
 */
class Pacients
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=25, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="cognom", type="string", length=25, nullable=false)
     */
    private $cognom;

    /**
     * @var string
     *
     * @ORM\Column(name="dolencia", type="string", length=255, nullable=false)
     */
    private $dolencia;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=25)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $dni;



    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Pacients
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set cognom
     *
     * @param string $cognom
     *
     * @return Pacients
     */
    public function setCognom($cognom)
    {
        $this->cognom = $cognom;

        return $this;
    }

    /**
     * Get cognom
     *
     * @return string
     */
    public function getCognom()
    {
        return $this->cognom;
    }

    /**
     * Set dolencia
     *
     * @param string $dolencia
     *
     * @return Pacients
     */
    public function setDolencia($dolencia)
    {
        $this->dolencia = $dolencia;

        return $this;
    }

    /**
     * Get dolencia
     *
     * @return string
     */
    public function getDolencia()
    {
        return $this->dolencia;
    }

    /**
     * Get dni
     *
     * @return string
     */
    public function getDni()
    {
        return $this->dni;
    }
    /**
     * Set dni
     *
     * @param string $dni
     *
     * @return Pacients
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }
}
