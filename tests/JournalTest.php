<?php

use Mockery as m;

class JournalTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        m::close();
    }

    public function testScreenshotSavesThePngBits()
    {
        $w = self::writer();
        $w->shouldReceive('save')->once()->with(m::any(), 'png-bits');

        $j = new WebDriverJournal\Journal($w);
        $j->screenshot('png-bits');
    }

    public function testScreenshotGeneratesPngFileName()
    {
        $w = self::writer();
        $w->shouldReceive('save')->once()->with('/^[a-z0-9]+\.png$/', m::any());

        $j = new WebDriverJournal\Journal($w);
        $j->screenshot('');
    }

    public function testScreenshotLogsToIndexHtml()
    {
        $w = self::writer();
        $w->shouldReceive('log')->once()->with('index.html', m::any());

        $j = new WebDriverJournal\Journal($w);
        $j->screenshot('');
    }

    public function testScreenshotLogsTheHtmlImageItem()
    {
        $w = self::writer();
        $w->shouldReceive('log')->once()->with(m::any(), '/<img src=".*\.png/');

        $j = new WebDriverJournal\Journal($w);
        $j->screenshot('');
    }

    private static function writer()
    {
        return m::mock('writer')->shouldIgnoreMissing();
    }
}
