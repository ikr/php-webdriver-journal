<?php

namespace WebDriverJournal;

class DirectoryFilesWriter
{
    public function __construct($parentDirPath, $ownDirName)
    {
        $this->parentDirPath = $parentDirPath;
        $this->ownDirName = $ownDirName;
    }

    public function write()
    {
    }
}
