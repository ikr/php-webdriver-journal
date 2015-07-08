<?php

use WebDriverJournal\DirectoryFilesWriter;

class DirectoryFilesWriterTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        mkdir(self::parentDirPath());
    }

    protected function tearDown()
    {
        rmdir(self::parentDirPath());
    }

    /**
     * @expectedException ErrorException
     */
    public function testConstructorExplodesOnANastyOwnDirName()
    {
        new DirectoryFilesWriter(self::parentDirPath(), '/../../../../root');
    }

    /**
     * @expectedException ErrorException
     */
    public function testConstructorExplodesOnTheDotDotOwnDirName()
    {
        new DirectoryFilesWriter(self::parentDirPath(), '..');
    }

    public function testWrite()
    {
        $w = new DirectoryFilesWriter(self::parentDirPath(), 'testWrite');
        $w->write('README.md', '# Intro');

        $this->assertSame(
            '# Intro',

            file_get_contents(
                self::parentDirPath() . '/testWrite/README.md'
            )
        );

        unlink(self::parentDirPath() . '/testWrite/README.md');
        rmdir(self::parentDirPath() . '/testWrite');
    }

    private static function parentDirPath()
    {
        return sys_get_temp_dir() . '/' . __CLASS__;
    }
}
