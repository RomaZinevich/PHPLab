<?php
namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: PatientRepository::class)]
class Patient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $firstName;

    #[ORM\Column(length: 255)]
    private string $lastName;

    #[ORM\Column(type: 'date')]
    private \DateTimeInterface $birthDate;

    #[ORM\Column(length: 10)]
    private string $gender;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $phone = null;

    // Зв'язок "багато до багатьох" з лікарями
    #[ORM\ManyToMany(targetEntity: Doctor::class, inversedBy: 'patients')]
    #[ORM\JoinTable(name: 'doctor_patient')]
    private Collection $doctors;

    public function __construct()
    {
        $this->doctors = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getFirstName(): string { return $this->firstName; }
    public function setFirstName(string $firstName): self { $this->firstName = $firstName; return $this; }
    public function getLastName(): string { return $this->lastName; }
    public function setLastName(string $lastName): self { $this->lastName = $lastName; return $this; }
    public function getBirthDate(): \DateTimeInterface { return $this->birthDate; }
    public function setBirthDate(\DateTimeInterface $birthDate): self { $this->birthDate = $birthDate; return $this; }
    public function getGender(): string { return $this->gender; }
    public function setGender(string $gender): self { $this->gender = $gender; return $this; }
    public function getPhone(): ?string { return $this->phone; }
    public function setPhone(?string $phone): self { $this->phone = $phone; return $this; }

    public function getDoctors(): Collection { return $this->doctors; }
    public function addDoctor(Doctor $doctor): self {
        if (!$this->doctors->contains($doctor)) {
            $this->doctors[] = $doctor;
        }
        return $this;
    }
    public function removeDoctor(Doctor $doctor): self {
        $this->doctors->removeElement($doctor);
        return $this;
    }
}

