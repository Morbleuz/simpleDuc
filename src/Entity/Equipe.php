<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use ApiPlatform\Core\Annotation\ApiResource;


#[ApiResource()]
#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomEquipe = null;

    #[ORM\ManyToMany(targetEntity: Developpeur::class, mappedBy: 'equipes')]
    #[MaxDepth(1)]
    private Collection $developpeurs;

    #[ORM\OneToMany(mappedBy: 'equipe', targetEntity: Projet::class)]
    private Collection $projet;

    public function __construct()
    {
        $this->developpeurs = new ArrayCollection();
        $this->projet = new ArrayCollection();
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

    /**
     * @return Collection<int, Projet>
     */
    public function getProjet(): Collection
    {
        return $this->projet;
    }

    public function addProjet(Projet $projet): self
    {
        if (!$this->projet->contains($projet)) {
            $this->projet->add($projet);
            $projet->setEquipe($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): self
    {
        if ($this->projet->removeElement($projet)) {
            // set the owning side to null (unless already changed)
            if ($projet->getEquipe() === $this) {
                $projet->setEquipe(null);
            }
        }

        return $this;
    }

}
