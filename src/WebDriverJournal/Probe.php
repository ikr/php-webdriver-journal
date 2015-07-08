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

        if ($pngBuffer === $this->pngBuffer) {
            return;
        }

        $this->journal->screenshot($pngBuffer);
        $this->pngBuffer = $pngBuffer;
    }
}