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
}
