<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlageHasEspece
 *
 * @ORM\Table(name="plage_has_espece", indexes={@ORM\Index(name="idPlage", columns={"idPlage", "idEspece"})})
 * @ORM\Entity
 */
class PlageHasEspece
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPlage", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idplage;

    /**
     * @var int
     *
     * @ORM\Column(name="idEspece", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idespece;

    /**
     * @var int
     *
     * @ORM\Column(name="idetude", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idetude;

    /**
     * @var int
     *
     * @ORM\Column(name="nombreEspece", type="integer", nullable=false)
     */
    private $nombreespece;

    public function getIdplage(): ?int
    {
        return $this->idplage;
    }

    public function setIdplage(int $idplage): self
    {
        $this->idplage = $idplage;

        return $this;
    }

    public function getIdespece(): ?int
    {
        return $this->idespece;
    }

    public function setIdespece(int $idespece): self
    {
        $this->idespece = $idespece;

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


    public function getNombreespece(): ?int
    {
        return $this->nombreespece;
    }

    public function setNombreespece(int $nombreespece): self
    {
        $this->nombreespece = $nombreespece;

        return $this;
    }


}
