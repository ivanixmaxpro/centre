<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tractaments
 *
 * @ORM\Table(name="tractaments", indexes={@ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Tractaments
{
    /**
     * @var string
     *
     * @ORM\Column(name="tipus", type="string", length=25, nullable=false)
     */
    private $tipus;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set tipus
     *
     * @param string $tipus
     *
     * @return Tractaments
     */
    public function setTipus($tipus)
    {
        $this->tipus = $tipus;

        return $this;
    }

    /**
     * Get tipus
     *
     * @return string
     */
    public function getTipus()
    {
        return $this->tipus;
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
}
