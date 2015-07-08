<?php

namespace WebDriverJournal;

class DirectoryFilesWriter
{
    public function __construct($parentDirPath, $ownDirName)
    {
        self::assertNoFileSystemTricks($ownDirName);
        $this->dirPath = $parentDirPath . '/' . $ownDirName;
    }

    public function write($fileName, $fileContents)
    {
        self::assertNoFileSystemTricks($fileName);
        $this->ensureDirPresence();
        file_put_contents($this->dirPath . '/' . $fileName, $fileContents);
    }

    private function ensureDirPresence()
    {
        if (!is_dir($this->dirPath)) {
            mkdir($this->dirPath, 0775);
        }
    }

    private static function assertNoFileSystemTricks($name)
    {
        assert(preg_match('/\//', $name) === 0, 'No slashes in file system names');
        assert(preg_match('/^\.\./', $name) === 0, 'No leading ".."');
    }
}
