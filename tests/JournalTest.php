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

    public function testScreenshotLogsToLogMd()
    {
        $w = self::writer();
        $w->shouldReceive('log')->once()->with('log.md', m::any());

        $j = new WebDriverJournal\Journal($w);
        $j->screenshot('');
    }

    public function testScreenshotLogsTheMarkdownImageItem()
    {
        $w = self::writer();
        $w->shouldReceive('log')->once()->with(m::any(), '/!\[.*\]\(.*\.png/');

        $j = new WebDriverJournal\Journal($w);
        $j->screenshot('');
    }

    private static function writer()
    {
        return m::mock('writer')->shouldIgnoreMissing();
    }
}
