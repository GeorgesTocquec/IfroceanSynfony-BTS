<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Plage
 *
 * @ORM\Table(name="plage", indexes={@ORM\Index(name="fk_Plage_Lieu1_idx", columns={"idLieu"})})
 * @ORM\Entity
 */
class Plage
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPlage", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idplage;

    /**
     * @var string
     *
     * @Assert\NotBlank
     * @ORM\Column(name="nomPlage", type="string", length=255, nullable=false)
     */
    private $nomplage;

    /**
     * @var string|null
     *
     * @Assert\NotBlank
     * @ORM\Column(name="superficietotalePlage", type="string", length=10, nullable=true)
     */
    private $superficietotaleplage;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nombredespecePlage", type="integer", nullable=true)
     */
    private $nombredespeceplage;

    /**
     * @var int|null
     * 
     *@Assert\NotBlank
     * @ORM\Column(name="densiteespecePlage", type="integer", nullable=true)
     */
    private $densiteespeceplage;

    /**
     * @var int
     *
     * @ORM\Column(name="idLieu", type="integer", nullable=false)
     */
    private $idlieu;

    public function getIdplage(): ?int
    {
        return $this->idplage;
    }

    public function getNomplage(): ?string
    {
        return $this->nomplage;
    }

    public function setNomplage(string $nomplage): self
    {
        $this->nomplage = $nomplage;

        return $this;
    }

    public function getSuperficietotaleplage(): ?string
    {
        return $this->superficietotaleplage;
    }

    public function setSuperficietotaleplage(?string $superficietotaleplage): self
    {
        $this->superficietotaleplage = $superficietotaleplage;

        return $this;
    }

    public function getNombredespeceplage(): ?int
    {
        return $this->nombredespeceplage;
    }

    public function setNombredespeceplage(?int $nombredespeceplage): self
    {
        $this->nombredespeceplage = $nombredespeceplage;

        return $this;
    }

    public function getDensiteespeceplage(): ?int
    {
        return $this->densiteespeceplage;
    }

    public function setDensiteespeceplage(?int $densiteespeceplage): self
    {
        $this->densiteespeceplage = $densiteespeceplage;

        return $this;
    }


    
    public function setIdlieu(?int $idlieu): self
    {
        $this->idlieu = $idlieu;

        return $this;
    }

    public function getIdlieu(): ?int
    {
        return $this->idlieu;
    }


}
