<?php

class WebDriverProxyTest extends PHPUnit_Framework_TestCase
{
    public function testInstantiation()
    {
        $this->assertNotNull(new WebDriverJournal\WebDriverProxy);
    }
}
