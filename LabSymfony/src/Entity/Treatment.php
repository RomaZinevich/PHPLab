<?php

namespace App\Entity;

use App\Repository\TreatmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TreatmentRepository::class)]
class Treatment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $instructions = null;

    #[ORM\ManyToOne]
    private Diagnosis $diagnosis;

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function setName(string $name): self { $this->name = $name; return $this; }
    public function getInstructions(): ?string { return $this->instructions; }
    public function setInstructions(?string $instructions): self { $this->instructions = $instructions; return $this; }
    public function getDiagnosis(): Diagnosis { return $this->diagnosis; }
    public function setDiagnosis(Diagnosis $diagnosis): self { $this->diagnosis = $diagnosis; return $this; }
}

