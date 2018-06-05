<?php

namespace App;

use App\Handlers\ErrorRequestHandler;
use function DI\create;

return [
    'ErrorHandler' => create(ErrorRequestHandler::class)
];