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
        $d->shouldReceive('takeScreenshot')->andReturn(self::bigEnoughRaster());

        $j = m::mock('journal');
        $j->shouldReceive('screenshot')->once()->with(self::bigEnoughRaster());

        $p = new WebDriverJournal\Probe($d, $j);
        $p->run();
    }

    public function testSecondRunWithTheSamePngBufferDoesntCallTheJournal()
    {
        $d = m::mock('driver');
        $d->shouldReceive('takeScreenshot')->andReturn(self::bigEnoughRaster());

        $j = m::mock('journal');
        $j->shouldReceive('screenshot')->once()->with(self::bigEnoughRaster());

        $p = new WebDriverJournal\Probe($d, $j);
        $p->run();
        $p->run();
    }

    public function testRunIgnoresATooSmallScreenshotRaster()
    {
        $d = m::mock('driver');
        $d->shouldReceive('takeScreenshot')->andReturn('000');

        $j = m::mock('journal');
        $j->shouldReceive('screenshot')->never();

        $p = new WebDriverJournal\Probe($d, $j);
        $p->run();
    }

    private static function bigEnoughRaster()
    {
        return str_repeat('0', 5000);
    }
}
