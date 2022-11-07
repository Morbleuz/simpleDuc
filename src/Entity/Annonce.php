<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnonceRepository::class)]
class Annonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomAnnonce = null;

    #[ORM\Column(length: 255)]
    private ?string $PosteAPromouvoir = null;

    #[ORM\Column]
    private ?int $SalaireDeBase = null;

    #[ORM\Column(length: 255)]
    private ?string $Qualification = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAnnonce(): ?string
    {
        return $this->NomAnnonce;
    }

    public function setNomAnnonce(string $NomAnnonce): self
    {
        $this->NomAnnonce = $NomAnnonce;

        return $this;
    }

    public function getPosteAPromouvoir(): ?string
    {
        return $this->PosteAPromouvoir;
    }

    public function setPosteAPromouvoir(string $PosteAPromouvoir): self
    {
        $this->PosteAPromouvoir = $PosteAPromouvoir;

        return $this;
    }

    public function getSalaireDeBase(): ?int
    {
        return $this->SalaireDeBase;
    }

    public function setSalaireDeBase(int $SalaireDeBase): self
    {
        $this->SalaireDeBase = $SalaireDeBase;

        return $this;
    }

    public function getQualification(): ?string
    {
        return $this->Qualification;
    }

    public function setQualification(string $Qualification): self
    {
        $this->Qualification = $Qualification;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }
}
