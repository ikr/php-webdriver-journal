<?php

use Mockery as m;

class WebDriverProxyTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        m::close();
    }

    /**
     * @dataProvider proxiedMethods
     */
    public function testProbing($webDriverMethodName)
    {
        $driver = m::mock('driver');

        $driver
            ->shouldReceive($webDriverMethodName)
            ->once()
            ->with('foo-arg', 'bar-arg')
            ->andReturn('le-result');

        $probe = m::mock('probe');
        $probe->shouldReceive('run')->twice();

        $proxy = new WebDriverJournal\WebDriverProxy($driver, $probe);
        $result = $proxy->$webDriverMethodName('foo-arg', 'bar-arg');

        $this->assertSame('le-result', $result);
    }

    public static function proxiedMethods()
    {
        return [
            ['findElement'],
            ['findElements'],
            ['executeScript'],
            ['manage']
        ];
    }
}
