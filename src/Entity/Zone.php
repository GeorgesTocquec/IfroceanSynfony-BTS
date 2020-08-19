<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Zone
 *
 * @ORM\Table(name="zone")
 * @ORM\Entity
 */
class Zone
{
    /**
     * @var int
     *
     * @ORM\Column(name="idZone", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idzone;

    /**
     * @var string
     *
     * @Assert\NotBlank
     * @ORM\Column(name="NomZone", type="string", length=255, nullable=false)
     */
    private $nomzone;

    public function getIdzone(): ?int
    {
        return $this->idzone;
    }

    public function getNomzone(): ?string
    {
        return $this->nomzone;
    }

    public function setNomzone(string $nomzone): self
    {
        $this->nomzone = $nomzone;

        return $this;
    }


}
