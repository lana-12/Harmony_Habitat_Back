<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

// if ($_SERVER['REQUEST_METHOD'] === "OPTIONS") {
//     http_response_code(200);
//     exit();
// }

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
