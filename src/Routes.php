<?php

return [
    ['GET', '/hello-world', function () {
        echo 'Hello World';
    }],
    ['GET', '/', [App\Controllers\Homepage::class, 'show']],
];
