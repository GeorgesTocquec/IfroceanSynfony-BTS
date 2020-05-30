<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EtudeHasEspece
 *
 * @ORM\Table(name="etude_has_espece", indexes={@ORM\Index(name="idEtude", columns={"idEtude", "idEspece"})})
 * @ORM\Entity
 */
class EtudeHasEspece
{
    /**
     * @var int
     *
     * @ORM\Column(name="idEtude", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idetude;

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
     * @ORM\Column(name="nombreEspece", type="integer", nullable=false)
     */
    private $nombreespece;

    public function getIdetude(): ?int
    {
        return $this->idetude;
    }

    public function setIdetude(int $idetude): self
    {
        $this->idetude = $idetude;

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
