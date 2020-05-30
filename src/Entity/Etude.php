<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etude
 *
 * @ORM\Table(name="etude")
 * @ORM\Entity
 */
class Etude
{
    /**
     * @var int
     *
     * @ORM\Column(name="idEtude", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idetude;

    /**
     * @var string|null
     *
     * @ORM\Column(name="titreEtude", type="string", length=255, nullable=true)
     */
    private $titreetude;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateEtude", type="date", nullable=true)
     */
    private $dateetude;

    /**
     * @var string
     *
     * @ORM\Column(name="totalpersonneEtude", type="string", length=10, nullable=false)
     */
    private $totalpersonneetude;


    public function getIdetude(): ?int
    {
        return $this->idetude;
    }

    public function setIdetude(int $idetude): self
    {
        $this->idetude = $idetude;

        return $this;
    }

    public function getTitreetude(): ?string
    {
        return $this->titreetude;
    }

    public function setTitreetude(?string $titreetude): self
    {
        $this->titreetude = $titreetude;

        return $this;
    }

    public function getDateetude(): ?\DateTimeInterface
    {
        return $this->dateetude;
    }

    public function setDateetude(?\DateTimeInterface $dateetude): self
    {
        $this->dateetude = $dateetude;

        return $this;
    }

    public function getTotalpersonneetude(): ?string
    {
        return $this->totalpersonneetude;
    }

    public function setTotalpersonneetude(string $totalpersonneetude): self
    {
        $this->totalpersonneetude = $totalpersonneetude;

        return $this;
    }
}
