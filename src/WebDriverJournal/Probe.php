<?php

namespace WebDriverJournal;

class Probe
{
    public function __construct($webDriver, $journal)
    {
        $this->webDriver = $webDriver;
        $this->journal = $journal;
        $this->pngBuffer = null;
    }

    public function run()
    {
        $pngBuffer = $this->webDriver->takeScreenshot();

        if (self::screenshotIsTooSmall($pngBuffer) || $this->screenshotHasNotChanged($pngBuffer)) {
            return;
        }

        $this->journal->screenshot($pngBuffer);
        $this->pngBuffer = $pngBuffer;
    }

    private function screenshotHasNotChanged($pngBuffer)
    {
        return ($pngBuffer === $this->pngBuffer);
    }

    private static function screenshotIsTooSmall($pngBuffer)
    {
        return (strlen($pngBuffer) < 5000);
    }
}