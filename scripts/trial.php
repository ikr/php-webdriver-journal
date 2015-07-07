<?php

set_error_handler(
    function ($errno, $errstr, $errfile, $errline)
    {
        throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
    }
);

require __DIR__ . '/../vendor/autoload.php';

$driver = RemoteWebDriver::create('127.0.0.1:4444/wd/hub', DesiredCapabilities::phantomjs());
$driver->manage()->window()->setSize(new WebDriverDimension(1024, 1024));
$driver->manage()->timeouts()->implicitlyWait(8);

$driver->get('http://www.sbb.ch/geschaeftsreisen.html');
$driver->findElement(WebDriverBy::id('btUser'))->sendKeys('stc-cpedersoli');
