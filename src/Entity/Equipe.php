<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomEquipe = null;

    #[ORM\OneToOne(mappedBy: 'equipe', cascade: ['persist', 'remove'])]
    private ?Projet $projet = null;

    #[ORM\ManyToMany(targetEntity: Developpeur::class, mappedBy: 'equipes')]
    private Collection $developpeurs;

    public function __construct()
    {
        $this->developpeurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEquipe(): ?string
    {
        return $this->NomEquipe;
    }

    public function setNomEquipe(string $NomEquipe): self
    {
        $this->NomEquipe = $NomEquipe;

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): self
    {
        // unset the owning side of the relation if necessary
        if ($projet === null && $this->projet !== null) {
            $this->projet->setEquipe(null);
        }

        // set the owning side of the relation if necessary
        if ($projet !== null && $projet->getEquipe() !== $this) {
            $projet->setEquipe($this);
        }

        $this->projet = $projet;

        return $this;
    }

    /**
     * @return Collection<int, Developpeur>
     */
    public function getDeveloppeurs(): Collection
    {
        return $this->developpeurs;
    }

    public function addDeveloppeur(Developpeur $developpeur): self
    {
        if (!$this->developpeurs->contains($developpeur)) {
            $this->developpeurs->add($developpeur);
            $developpeur->addEquipe($this);
        }

        return $this;
    }

    public function removeDeveloppeur(Developpeur $developpeur): self
    {
        if ($this->developpeurs->removeElement($developpeur)) {
            $developpeur->removeEquipe($this);
        }

        return $this;
    }

}
