<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CentreMedic
 *
 * @ORM\Table(name="centre-medic")
 * @ORM\Entity
 */
class CentreMedic
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var integer
     *
     * @ORM\Column(name="codi", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codi;



    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return CentreMedic
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
     * Get codi
     *
     * @return integer
     */
    public function getCodi()
    {
        return $this->codi;
    }
}
