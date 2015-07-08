<?php

use Mockery as m;

class ProbeTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown() {
        m::close();
    }

    public function testInitialRunTakesAScreenshotViaDriver()
    {
        $d = m::mock('driver');
        $d->shouldReceive('takeScreenshot')->once();

        $j = m::mock('journal')->shouldIgnoreMissing();

        $p = new WebDriverJournal\Probe($d, $j);
        $p->run();
    }

    public function testInitialRunSendsTheScreenshotPngBufferToTheJournal()
    {
        $d = m::mock('driver');
        $d->shouldReceive('takeScreenshot')->andReturn('png-bits');

        $j = m::mock('journal');
        $j->shouldReceive('screenshot')->once()->with('png-bits');

        $p = new WebDriverJournal\Probe($d, $j);
        $p->run();
    }

    public function testSecondRunWithTheSamePngBufferDoesntCallTheJournal()
    {
        $d = m::mock('driver');
        $d->shouldReceive('takeScreenshot')->andReturn('png-bits');

        $j = m::mock('journal');
        $j->shouldReceive('screenshot')->once()->with('png-bits');

        $p = new WebDriverJournal\Probe($d, $j);
        $p->run();
        $p->run();
    }
}
