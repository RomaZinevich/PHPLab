<?php

namespace App\Entity;

use App\Repository\DoctorRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: DoctorRepository::class)]
class Doctor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $firstName;

    #[ORM\Column(length: 255)]
    private string $lastName;

    #[ORM\Column(length: 255)]
    private string $specialization;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $phone = null;

    // Зв'язок "багато до багатьох" з пацієнтами
    #[ORM\ManyToMany(targetEntity: Patient::class, mappedBy: 'doctors')]
    private Collection $patients;

    public function __construct()
    {
        $this->patients = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getFirstName(): string { return $this->firstName; }
    public function setFirstName(string $firstName): self { $this->firstName = $firstName; return $this; }
    public function getLastName(): string { return $this->lastName; }
    public function setLastName(string $lastName): self { $this->lastName = $lastName; return $this; }
    public function getSpecialization(): string { return $this->specialization; }
    public function setSpecialization(string $specialization): self { $this->specialization = $specialization; return $this; }
    public function getPhone(): ?string { return $this->phone; }
    public function setPhone(?string $phone): self { $this->phone = $phone; return $this; }

    public function getPatients(): Collection { return $this->patients; }
    public function addPatient(Patient $patient): self {
        if (!$this->patients->contains($patient)) {
            $this->patients[] = $patient;
            $patient->addDoctor($this);
        }
        return $this;
    }
    public function removePatient(Patient $patient): self {
        if ($this->patients->removeElement($patient)) {
            $patient->removeDoctor($this);
        }
        return $this;
    }
}
