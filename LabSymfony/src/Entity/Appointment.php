<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: AppointmentRepository::class)]
class Appointment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $appointmentTime;

    #[ORM\ManyToOne(inversedBy: 'appointments')]
    private Patient $patient;

    #[ORM\ManyToOne(inversedBy: 'appointments')]
    private Doctor $doctor;

    #[ORM\OneToMany(mappedBy: 'appointment', targetEntity: Diagnosis::class)]
    private Collection $diagnoses;

    public function __construct()
    {
        $this->diagnoses = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getAppointmentTime(): \DateTimeInterface { return $this->appointmentTime; }
    public function setAppointmentTime(\DateTimeInterface $time): self { $this->appointmentTime = $time; return $this; }
    public function getPatient(): Patient { return $this->patient; }
    public function setPatient(Patient $patient): self { $this->patient = $patient; return $this; }
    public function getDoctor(): Doctor { return $this->doctor; }
    public function setDoctor(Doctor $doctor): self { $this->doctor = $doctor; return $this; }
    public function getDiagnoses(): Collection { return $this->diagnoses; }
    public function addDiagnosis(Diagnosis $diagnosis): self {
        if (!$this->diagnoses->contains($diagnosis)) {
            $this->diagnoses[] = $diagnosis;
            $diagnosis->setAppointment($this);
        }
        return $this;
    }
    public function removeDiagnosis(Diagnosis $diagnosis): self {
        if ($this->diagnoses->removeElement($diagnosis)) {
            if ($diagnosis->getAppointment() === $this) {
                $diagnosis->setAppointment(null);
            }
        }
        return $this;
    }
}

