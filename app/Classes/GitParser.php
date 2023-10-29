<?php

namespace App\Classes;

class GitParser
{
    public string $fileOutputs;
    const PATH_OUTPUT="/storage/gitoutputs/";
    public function __construct($fileName)
    {
        $this->fileOutputs=$fileName;
    }

    public function parseDiff()
    {
        $lines=$this->readFileOutput();
        foreach ($lines as $line) {

        }
    }

    public function readFileOutput()
    {
        $handle = fopen($_SERVER["DOCUMENT_ROOT"].static::PATH_OUTPUT.$this->fileOutputs, "r");

        while(!feof($handle)) {
            yield fgets($handle);
        }

        fclose($handle);
    }
}
