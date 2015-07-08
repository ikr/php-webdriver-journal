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

    public function testSave()
    {
        $w = new DirectoryFilesWriter(self::parentDirPath(), 'testSave');
        $w->save('README.md', '# Intro');

        $this->assertSame(
            '# Intro',

            file_get_contents(
                self::parentDirPath() . '/testSave/README.md'
            )
        );

        unlink(self::parentDirPath() . '/testSave/README.md');
        rmdir(self::parentDirPath() . '/testSave');
    }

    public function testLog()
    {
        $w = new DirectoryFilesWriter(self::parentDirPath(), 'testLog');
        $w->log('log.md', '* One');
        $w->log('log.md', '* Two');

        $this->assertSame(
            "* One\n* Two\n",

            file_get_contents(
                self::parentDirPath() . '/testLog/log.md'
            )
        );

        unlink(self::parentDirPath() . '/testLog/log.md');
        rmdir(self::parentDirPath() . '/testLog');
    }

    private static function parentDirPath()
    {
        return sys_get_temp_dir() . '/' . __CLASS__;
    }
}
