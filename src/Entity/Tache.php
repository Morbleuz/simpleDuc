<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TacheRepository::class)]
class Tache
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomTache = null;

    #[ORM\Column]
    private ?bool $estFaite = null;

    #[ORM\ManyToOne(inversedBy: 'Taches')]
    private ?Developpeur $developpeur = null;

    public function __construct()
    {
        $this->developpeurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTache(): ?string
    {
        return $this->nomTache;
    }

    public function setNomTache(string $nomTache): self
    {
        $this->nomTache = $nomTache;

        return $this;
    }

    public function isEstFaite(): ?bool
    {
        return $this->estFaite;
    }

    public function setEstFaite(bool $estFaite): self
    {
        $this->estFaite = $estFaite;

        return $this;
    }

    public function getDeveloppeur(): ?Developpeur
    {
        return $this->developpeur;
    }

    public function setDeveloppeur(?Developpeur $developpeur): self
    {
        $this->developpeur = $developpeur;

        return $this;
    }

}
