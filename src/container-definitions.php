<?php

namespace App;

use App\Handlers\ErrorRequestHandler;
use App\Handlers\CarsRequestHandler;
use App\Data\RepositoryInterface;
use App\Data\CarsRepository;
use function DI\create;
use function DI\get;

return [
    RepositoryInterface::class => create(CarsRepository::class),
    'ErrorHandler' => create(ErrorRequestHandler::class),
    'CarsHandler' => get(CarsRequestHandler::class),
    CarsRequestHandler::class =>
        create(CarsRequestHandler::class)->constructor(get(RepositoryInterface::class)),
];