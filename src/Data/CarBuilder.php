<?php
declare(strict_types = 1);

namespace App\Data;
use TypeError;
use Middlewares\HttpErrorException;

class CarBuilder implements CarBuilderInterface
{
    private $car;

    public function __construct()
    {
        $this->car = new Car();
    }

    public function build(): ModelInterface
    {
        return $this->car;
    }

    public function buildFromJsonString(string $json): ModelInterface
    {
        $decoded = json_decode($json);
        
        try {            
            return $this
                ->setId($decoded->id)
                ->setBrand($decoded->brand)
                ->setModel($decoded->model)
                ->setYear($decoded->year)
                ->build();
        } catch (TypeError $e) {
            throw HttpErrorException::create(400);
        }
    }   

    public function setId(string $id): CarBuilderInterface
    {
        $this->car->setId($id);
        return $this;
    }

    public function setBrand(string $brand): CarBuilderInterface
    {
        $this->car->setBrand($brand);
        return $this;
    }

    public function setModel(string $model): CarBuilderInterface
    {
        $this->car->setModel($model);
        return $this;
    }

    public function setYear(int $year): CarBuilderInterface
    {
        $this->car->setYear($year);
        return $this;
    }
}