<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PlageHasEtude
 *
 * @ORM\Table(name="plage_has_etude", indexes={@ORM\Index(name="idPlage", columns={"idPlage", "idEtude"}), @ORM\Index(name="idZone", columns={"idZone"})})
 * @ORM\Entity
 */
class PlageHasEtude
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPlage", type="integer", nullable=false)
     */
    private $idplage;

    /**
     * @var int
     *
     * @ORM\Column(name="idEtude", type="integer", nullable=false)
     */
    private $idetude;

    /**
     * @var int
     *
     * @ORM\Column(name="idZone", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idzone;

    /**
     * @var int|null
     *
     * @Assert\NotBlank
     * @ORM\Column(name="Angle1", type="integer", nullable=true)
     */
    private $angle1;

    /**
     * @var int|null
     *
     * @Assert\NotBlank
     * @ORM\Column(name="Angle2", type="integer", nullable=true)
     */
    private $angle2;

    /**
     * @var int|null
     *
     * @Assert\NotBlank
     * @ORM\Column(name="Angle3", type="integer", nullable=true)
     */
    private $angle3;

    /**
     * @var int|null
     *
     * @Assert\NotBlank
     * @ORM\Column(name="Angle4", type="integer", nullable=true)
     */
    private $angle4;

    public function getIdplage(): ?int
    {
        return $this->idplage;
    }

    public function setIdplage(int $idplage): self
    {
        $this->idplage = $idplage;

        return $this;
    }

    public function getIdetude(): ?int
    {
        return $this->idetude;
    }

    public function setIdetude(int $idetude): self
    {
        $this->idetude = $idetude;

        return $this;
    }

    public function getIdzone(): ?int
    {
        return $this->idzone;
    }

    public function getAngle1(): ?int
    {
        return $this->angle1;
    }

    public function setAngle1(?int $angle1): self
    {
        $this->angle1 = $angle1;

        return $this;
    }

    public function getAngle2(): ?int
    {
        return $this->angle2;
    }

    public function setAngle2(?int $angle2): self
    {
        $this->angle2 = $angle2;

        return $this;
    }

    public function getAngle3(): ?int
    {
        return $this->angle3;
    }

    public function setAngle3(?int $angle3): self
    {
        $this->angle3 = $angle3;

        return $this;
    }

    public function getAngle4(): ?int
    {
        return $this->angle4;
    }

    public function setAngle4(?int $angle4): self
    {
        $this->angle4 = $angle4;

        return $this;
    }


}
