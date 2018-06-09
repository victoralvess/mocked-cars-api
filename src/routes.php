<?php

return [
    ['GET', '/cars[/[{action:all}]]', 'CarsHandler'],
    ['POST', '/cars/{action:add}', 'CarsHandler'],
    ['DELETE', '/cars/{action:remove}/{id:\w+}', 'CarsHandler']
];
