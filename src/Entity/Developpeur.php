<?php

namespace App\Entity;

use App\Repository\DeveloppeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ApiResource(
    itemOperations: ["get"=>["security"=>"is_granted('ROLE_ADMIN') or object == user"],] 
)]
#[ORM\Entity(repositoryClass: DeveloppeurRepository::class)]
class Developpeur extends Employe
{

    #[ORM\ManyToMany(targetEntity: Equipe::class, inversedBy: 'developpeurs')]
    #[MaxDepth(1)]
    private Collection $equipes;

    #[ORM\OneToMany(mappedBy: 'developpeur', targetEntity: Tache::class, orphanRemoval: true)]
    private Collection $taches;

    public function __construct()
    {
        $this->equipes = new ArrayCollection();
        $this->taches = new ArrayCollection();
    }

    /**
     * @return Collection<int, Equipe>
     */
    public function getEquipes(): Collection
    {
        return $this->equipes;
    }

    public function addEquipe(Equipe $equipe): self
    {
        if (!$this->equipes->contains($equipe)) {
            $this->equipes->add($equipe);
        }

        return $this;
    }

    public function removeEquipe(Equipe $equipe): self
    {
        $this->equipes->removeElement($equipe);

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
            $tach->setDeveloppeur($this);
        }

        return $this;
    }

    public function removeTach(Tache $tach): self
    {
        if ($this->taches->removeElement($tach)) {
            // set the owning side to null (unless already changed)
            if ($tach->getDeveloppeur() === $this) {
                $tach->setDeveloppeur(null);
            }
        }

        return $this;
    }


}
