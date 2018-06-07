<?php
declare(strict_types = 1);

namespace App\Data;

interface CarBuilderInterface extends BuilderInterface
{
    public function build(): ModelInterface;
    public function buildFromJsonString(string $json): ModelInterface;
    public function setId(string $id): CarBuilderInterface;
    public function setBrand(string $brand): CarBuilderInterface;
    public function setModel(string $model): CarBuilderInterface;
    public function setYear(int $year): CarBuilderInterface;
}
