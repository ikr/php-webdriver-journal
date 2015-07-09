<?php

namespace WebDriverJournal;

class DirectoryFilesWriter
{
    public function __construct($parentDirPath, $ownDirName)
    {
        self::assertFsName($ownDirName);
        $this->dirPath = $parentDirPath . '/' . $ownDirName;
    }

    public function save($fileName, $fileContents)
    {
        self::assertFsName($fileName);
        $this->ensureDirPresence();
        file_put_contents($this->filePath($fileName), $fileContents);
    }

    public function log($fileName, $message)
    {
        self::assertFsName($fileName);
        $this->ensureDirPresence();
        file_put_contents($this->filePath($fileName), $message . "\n", FILE_APPEND);
    }

    private function filePath($fileName)
    {
        return $this->dirPath . '/' . $fileName;
    }

    private function ensureDirPresence()
    {
        if (!is_dir($this->dirPath)) {
            mkdir($this->dirPath, 0775);
        }
    }

    private static function assertFsName($name)
    {
        if (preg_match('/\//', $name) !== 0) {
            throw new \RuntimeException('No slashes in file system name');
        }

        if (preg_match('/^\.\./', $name) !== 0) {
            throw new \RuntimeException('No leading ".." in file system name');
        }
    }
}
