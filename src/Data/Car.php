<?php
declare(strict_types = 1);

namespace App\Data;

class Car implements ModelInterface
{
    private $id;
    private $brand;
    private $model;
    private $year;

    public function getId(): string
    {
        return $this->id;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    public function toJson(): array
    {
        return get_object_vars($this);
    }

    public function toString(): string
    {
        return json_encode($this->toJson());
    }
}
