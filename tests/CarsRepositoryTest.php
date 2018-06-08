<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\Data\{CarsRepository, CarBuilder};

final class CarsRepositoryTest extends TestCase
{
    public function testAdd()
    {
        $repository = new CarsRepository(__DIR__.'/test-data.json');
        $builder = new CarBuilder();
        
        $car = $builder->buildFromJsonString('
            {"id":"id", "brand":"brand", "model":"model","year":1990}
        ');

        $added = $repository->add($car);

        $this->assertEquals($car->toJson(), $added);
    }
}
