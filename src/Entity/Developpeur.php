<?php

namespace App\Entity;

use App\Repository\DeveloppeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeveloppeurRepository::class)]
class Developpeur extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'developpeur', targetEntity: Tache::class)]
    private Collection $Taches;

    public function __construct()
    {
        $this->Taches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Tache>
     */
    public function getTaches(): Collection
    {
        return $this->Taches;
    }

    public function addTach(Tache $tach): self
    {
        if (!$this->Taches->contains($tach)) {
            $this->Taches->add($tach);
            $tach->setDeveloppeur($this);
        }

        return $this;
    }

    public function removeTach(Tache $tach): self
    {
        if ($this->Taches->removeElement($tach)) {
            // set the owning side to null (unless already changed)
            if ($tach->getDeveloppeur() === $this) {
                $tach->setDeveloppeur(null);
            }
        }

        return $this;
    }
}
