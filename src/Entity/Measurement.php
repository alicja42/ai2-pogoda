<?php

namespace App\Entity;

use App\Repository\MeasurementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MeasurementRepository::class)]
class Measurement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'measurements')]
    #[ORM\JoinColumn(nullable: true, onDelete: "SET NULL")]
    private ?Location $location = null;

    #[ORM\Column(type: "string", length: 10)]
    private ?string $date = null;

    #[ORM\Column(type: "decimal", precision: 3, scale: 0)]
    private ?string $celsius = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): static
    {
        $this->location = $location;
        return $this;
    }

    public function getDate(): ?\DateTime
    {
        if ($this->date === null) {
            return null;
        }

        return new \DateTime(trim($this->date));
    }

    public function setDate(\DateTime|string $date): static
    {
        if ($date instanceof \DateTime) {
            $this->date = $date->format('Y-m-d');
        } else {
            $this->date = (new \DateTime(trim($date)))->format('Y-m-d');
        }

        return $this;
    }

    public function getCelsius(): ?string
    {
        return $this->celsius;
    }

    public function setCelsius(string $celsius): static
    {
        $this->celsius = $celsius;
        return $this;
    }
}
