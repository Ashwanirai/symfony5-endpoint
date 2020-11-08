<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ModelSpecificationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ModelSpecificationRepository::class)
 */
class ModelSpecification
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $ram;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $hdd_value;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $hdd_unit;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $hdd_type;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $model_location;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getRam(): ?string
    {
        return $this->ram;
    }

    public function setRam(?string $ram): self
    {
        $this->ram = $ram;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getHddValue(): ?string
    {
        return $this->hdd_value;
    }

    public function setHddValue(string $hdd_value): self
    {
        $this->hdd_value = $hdd_value;

        return $this;
    }

    public function getHddUnit(): ?string
    {
        return $this->hdd_unit;
    }

    public function setHddUnit(?string $hdd_unit): self
    {
        $this->hdd_unit = $hdd_unit;

        return $this;
    }

    public function getHddType(): ?string
    {
        return $this->hdd_type;
    }

    public function setHddType(?string $hdd_type): self
    {
        $this->hdd_type = $hdd_type;

        return $this;
    }

    public function getModelLocation(): ?string
    {
        return $this->model_location;
    }

    public function setModelLocation(?string $model_location): self
    {
        $this->model_location = $model_location;

        return $this;
    }
}
