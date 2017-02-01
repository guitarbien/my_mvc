<?php

return [
    ['GET', '/', [App\Controllers\Homepage::class, 'show']],
    ['GET', '/{slug}', [App\Controllers\Page::class, 'show']],
];
