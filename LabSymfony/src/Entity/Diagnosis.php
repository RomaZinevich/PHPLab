<?php

namespace App\Entity;

use App\Repository\DiagnosisRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: DiagnosisRepository::class)]
class Diagnosis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\ManyToOne]
    private Appointment $appointment;

    #[ORM\OneToMany(mappedBy: 'diagnosis', targetEntity: Treatment::class)]
    private Collection $treatments;

    public function __construct()
    {
        $this->treatments = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getDescription(): string { return $this->description; }
    public function setDescription(string $description): self { $this->description = $description; return $this; }
    public function getAppointment(): Appointment { return $this->appointment; }
    public function setAppointment(Appointment $appointment): self { $this->appointment = $appointment; return $this; }
    public function getTreatments(): Collection { return $this->treatments; }
    public function addTreatment(Treatment $treatment): self {
        if (!$this->treatments->contains($treatment)) {
            $this->treatments[] = $treatment;
            $treatment->setDiagnosis($this);
        }
        return $this;
    }
    public function removeTreatment(Treatment $treatment): self {
        if ($this->treatments->removeElement($treatment)) {
            if ($treatment->getDiagnosis() === $this) {
                $treatment->setDiagnosis(null);
            }
        }
        return $this;
    }
}
