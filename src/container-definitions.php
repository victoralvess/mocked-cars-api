<?php

namespace App;

use App\Handlers\ErrorRequestHandler;
use App\Handlers\CarsRequestHandler;
use App\Data\RepositoryInterface;
use App\Data\CarsRepository;
use function DI\create;
use function DI\get;

return [
    RepositoryInterface::class => get(CarsRepository::class),
    CarsRepository::class =>
        create(CarsRepository::class)->constructor(/*get(*/[
            ['id' => 1, 'name' => 'car1'],
            ['id' => 2, 'name' => 'car2'],
        ]/*)*/),
    'ErrorHandler' => create(ErrorRequestHandler::class),
    'CarsHandler' => create(CarsRequestHandler::class),    
];