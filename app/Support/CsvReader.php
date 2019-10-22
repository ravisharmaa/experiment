<?php

namespace App\Support;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;
use League\Csv\Reader;
use League\Csv\Statement;
use RecursiveIteratorIterator;

class CsvReader
{
    /**
     * @var \RecursiveDirectoryIterator
     */
    protected $recursiveDirectoryIterator;

    /**
     * @var array
     */
    protected $parsedData = [];
    /**
     * @var Statement
     */
    protected $statement;

    /**
     * CsvReader constructor.
     *
     * @param $recursiveDirectoryIterator
     * @param $statement Statement
     */
    public function __construct($recursiveDirectoryIterator, $statement)
    {
        $this->recursiveDirectoryIterator = $recursiveDirectoryIterator;
        $this->statement = $statement;
    }

    /**
     * Imports the csv and parses them.
     *
     * @throws FileNotFoundException
     */
    public function import()
    {
        foreach (new RecursiveIteratorIterator($this->recursiveDirectoryIterator) as $filename => $file) {
            if ('csv' !== $file->getExtension()) {
                continue;
            }

            $this->parsedData[] = $this->statement->process(Reader::createFromPath($filename,'r')->setHeaderOffset(0));

            File::delete($filename);
        }

        if (empty($this->parsedData)) {
            throw new FileNotFoundException();
        }

        return $this->parsedData;
    }
}
