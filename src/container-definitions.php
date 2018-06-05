<?php

namespace App;

use App\Handlers\ErrorRequestHandler;
use App\Handlers\CarsRequestHandler;
use function DI\create;

return [
    'ErrorHandler' => create(ErrorRequestHandler::class),
    'CarsHandler' => create(CarsRequestHandler::class)
];