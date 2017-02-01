<?php declare(strict_types = 1);

return [
    ['GET', '/', [App\Controllers\Homepage::class, 'show']],
    ['GET', '/{slug}', [App\Controllers\Page::class, 'show']],
];
