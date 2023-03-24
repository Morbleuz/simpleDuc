<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

#[ORM\Entity(repositoryClass: EmployeRepository::class)]
class Employe extends User
{

    #[ORM\Column(length: 27, nullable: true)]
    private ?string $RIB = null;

    #[ORM\Column(nullable: true)]
    private ?int $NombreHeures = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Adresse = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $Sexe = null;

    #[ORM\OneToMany(mappedBy: 'sender', targetEntity: Email::class, orphanRemoval: true)]
    private Collection $SendEmail;

    #[ORM\OneToMany(mappedBy: 'receiver', targetEntity: Email::class, orphanRemoval: true)]
    private Collection $receiveEmail;

    #[ORM\OneToMany(mappedBy: 'employer', targetEntity: Reponse::class, orphanRemoval: true)]
    private Collection $reponses;




    public function __construct()
    {
        $this->SendEmail = new ArrayCollection();
        $this->receiveEmail = new ArrayCollection();
        $this->reponses = new ArrayCollection();
    }



    public function getRIB(): ?string
    {
        return $this->RIB;
    }

    public function setRIB(?string $RIB): self
    {
        $this->RIB = $RIB;

        return $this;
    }

    public function getNombreHeures(): ?int
    {
        return $this->NombreHeures;
    }

    public function setNombreHeures(?int $NombreHeures): self
    {
        $this->NombreHeures = $NombreHeures;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(?string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->Sexe;
    }

    public function setSexe(?string $Sexe): self
    {
        $this->Sexe = $Sexe;

        return $this;
    }

    /**
     * @return Collection<int, Email>
     */
    public function getSendEmail(): Collection
    {
        return $this->SendEmail;
    }

    public function addSendEmail(Email $sendEmail): self
    {
        if (!$this->SendEmail->contains($sendEmail)) {
            $this->SendEmail->add($sendEmail);
            $sendEmail->setSender($this);
        }

        return $this;
    }
    
    public function removeSendEmail(Email $sendEmail): self
    {
        if ($this->SendEmail->removeElement($sendEmail)) {
            // set the owning side to null (unless already changed)
            if ($sendEmail->getSender() === $this) {
                $sendEmail->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Email>
     */
    public function getReceiveEmail(): Collection
    {
        return $this->receiveEmail;
    }

    public function addReceiveEmail(Email $receiveEmail): self
    {
        if (!$this->receiveEmail->contains($receiveEmail)) {
            $this->receiveEmail->add($receiveEmail);
            $receiveEmail->setReceiver($this);
        }

        return $this;
    }

    public function removeReceiveEmail(Email $receiveEmail): self
    {
        if ($this->receiveEmail->removeElement($receiveEmail)) {
            // set the owning side to null (unless already changed)
            if ($receiveEmail->getReceiver() === $this) {
                $receiveEmail->setReceiver(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reponse>
     */
    public function getReponses(): Collection
    {
        return $this->reponses;
    }

    public function addReponse(Reponse $reponse): self
    {
        if (!$this->reponses->contains($reponse)) {
            $this->reponses->add($reponse);
            $reponse->setEmployer($this);
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): self
    {
        if ($this->reponses->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->getEmployer() === $this) {
                $reponse->setEmployer(null);
            }
        }

        return $this;
    }


}
