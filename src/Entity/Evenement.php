<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDeb = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\OneToMany(targetEntity: Tournoi::class, mappedBy: 'ev_id')]
    private Collection $tr_id;

    public function __construct()
    {
        $this->tr_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateDeb(): ?\DateTimeInterface
    {
        return $this->dateDeb;
    }

    public function setDateDeb(?\DateTimeInterface $dateDeb): static
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * @return Collection<int, Tournoi>
     */
    public function getTrId(): Collection
    {
        return $this->tr_id;
    }

    public function addTrId(Tournoi $trId): static
    {
        if (!$this->tr_id->contains($trId)) {
            $this->tr_id->add($trId);
            $trId->setEvId($this);
        }

        return $this;
    }

    public function removeTrId(Tournoi $trId): static
    {
        if ($this->tr_id->removeElement($trId)) {
            // set the owning side to null (unless already changed)
            if ($trId->getEvId() === $this) {
                $trId->setEvId(null);
            }
        }

        return $this;
    }
}
