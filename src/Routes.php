<?php declare(strict_types = 1);
/*
return [
    ['GET', '/hello-world', function () {
        echo 'Hello WorldRoutes';
    }],
    ['GET', '/another-route', function () {
        echo 'This works too';
    }],
];

*/
return [
    ['GET', '/', ['microphp\Controllers\Homepage', 'show']],
];

