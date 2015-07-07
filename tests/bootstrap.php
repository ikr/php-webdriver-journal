<?php

set_error_handler(
    function ($errno, $errstr, $errfile, $errline)
    {
        throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
    }
);

require __DIR__ . '/../vendor/autoload.php';
