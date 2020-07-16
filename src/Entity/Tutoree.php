<?php

namespace App\Entity;

use App\Repository\TutoreeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TutoreeRepository::class)
 */
class Tutoree
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Etudiant::class, inversedBy="tutoree", cascade={"persist", "remove"})
     */
    private $etudiant;

    /**
     * @ORM\OneToMany(targetEntity=Inscription::class, mappedBy="tutore")
     */
    private $inscriptions;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    /**
     * @return Collection|Inscription[]
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->setTutore($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->contains($inscription)) {
            $this->inscriptions->removeElement($inscription);
            // set the owning side to null (unless already changed)
            if ($inscription->getTutore() === $this) {
                $inscription->setTutore(null);
            }
        }

        return $this;
    }
}
