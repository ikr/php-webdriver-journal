<?php

namespace WebDriverJournal;

class Journal
{
    public function __construct($directoryFilesWriter)
    {
        $this->directoryFilesWriter = $directoryFilesWriter;
    }

    public function screenshot($pngBuffer)
    {
        $name = uniqid() . '.png';
        $this->directoryFilesWriter->save($name, $pngBuffer);
        $this->directoryFilesWriter->log('index.html', '<img src="' . $name . '">');
    }
}
