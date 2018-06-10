<?php

return [
    ['GET', '/cars[/]', 'CarsHandler'],
    ['GET', '/cars/{id:\w+}', 'CarsHandler'],
    ['POST', '/cars[/]', 'CarsHandler'],
    ['DELETE', '/cars/{id:\w+}', 'CarsHandler'],
];
