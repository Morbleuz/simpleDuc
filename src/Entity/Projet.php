<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomProjet = null;

    #[ORM\Column]
    private ?int $CoutTotalEstime = null;

    #[ORM\Column]
    private ?int $CoutReel = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProjet(): ?string
    {
        return $this->nomProjet;
    }

    public function setNomProjet(string $nomProjet): self
    {
        $this->nomProjet = $nomProjet;

        return $this;
    }

    public function getCoutTotalEstime(): ?int
    {
        return $this->CoutTotalEstime;
    }

    public function setCoutTotalEstime(int $CoutTotalEstime): self
    {
        $this->CoutTotalEstime = $CoutTotalEstime;

        return $this;
    }

    public function getCoutReel(): ?int
    {
        return $this->CoutReel;
    }

    public function setCoutReel(int $CoutReel): self
    {
        $this->CoutReel = $CoutReel;

        return $this;
    }
}
