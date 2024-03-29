<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ApiResource(normalizationContext:['groups' => ['read']])]
#[ORM\Entity(repositoryClass: ProjetRepository::class)]
#[UniqueEntity('nomProjet',message: 'le nom de projet est déjà utiliser')]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["read"])]
    private ?int $id = null;

    #[Groups(["read"])]
    #[ORM\Column(name: 'nomProjet', type: 'string', length: 50, unique: true)]
    private ?string $nomProjet = null;

    #[ORM\Column]
    #[Groups(["read"])]
    private ?int $CoutTotalEstime = null;

    #[ORM\Column]
    #[Groups(["read"])]
    private ?int $CoutReel = null;

    #[ORM\OneToMany(mappedBy: 'projet', targetEntity: Tache::class)]
    #[Groups(["read"])]
    private Collection $taches;

    #[ORM\ManyToOne(inversedBy: 'projet')]
    #[Groups(["read"])]
    private ?Equipe $equipe = null;

    public function __construct()
    {
        $this->taches = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Tache>
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

    public function addTach(Tache $tach): self
    {
        if (!$this->taches->contains($tach)) {
            $this->taches->add($tach);
            $tach->setProjet($this);
        }

        return $this;
    }

    public function removeTach(Tache $tach): self
    {
        if ($this->taches->removeElement($tach)) {
            // set the owning side to null (unless already changed)
            if ($tach->getProjet() === $this) {
                $tach->setProjet(null);
            }
        }

        return $this;
    }

    public function getEquipe(): ?Equipe
    {
        return $this->equipe;
    }

    public function setEquipe(?Equipe $equipe): self
    {
        $this->equipe = $equipe;

        return $this;
    }
}
