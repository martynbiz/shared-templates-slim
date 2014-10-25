<?php

return array(
    'templates.path' => './public/templates',
    'mode' => getenv('APPLICATION_ENV') ?: 'production',
    'debug' => false,
);
