<?php

class JournalTest extends PHPUnit_Framework_TestCase
{
    public function testInstantiation()
    {
        $this->assertNotNull(new WebDriverJournal\Journal);
    }
}
