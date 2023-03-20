<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToOne(inversedBy: 'annonces')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ResponsableRH $responsableRH = null;

    #[ORM\OneToMany(mappedBy: 'annonce', targetEntity: Candidat::class)]
    private Collection $candidats;


    public function __construct()
    {
        $this->candidats = new ArrayCollection();
    }

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

    public function getResponsableRH(): ?ResponsableRH
    {
        return $this->responsableRH;
    }

    public function setResponsableRH(?ResponsableRH $responsableRH): self
    {
        $this->responsableRH = $responsableRH;

        return $this;
    }

    /**
     * @return Collection<int, Candidat>
     */
    public function getCandidats(): Collection
    {
        return $this->candidats;
    }

    public function addCandidat(Candidat $candidat): self
    {
        if (!$this->candidats->contains($candidat)) {
            $this->candidats->add($candidat);
            $candidat->setAnnonce($this);
        }

        return $this;
    }

    public function removeCandidat(Candidat $candidat): self
    {
        if ($this->candidats->removeElement($candidat)) {
            // set the owning side to null (unless already changed)
            if ($candidat->getAnnonce() === $this) {
                $candidat->setAnnonce(null);
            }
        }

        return $this;
    }

    
}
