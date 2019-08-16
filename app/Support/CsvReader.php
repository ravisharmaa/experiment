<?php

namespace App\Support;

use App\Server;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use League\Csv\Reader;
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
     * CsvReader constructor.
     *
     * @param $recursiveDirectoryIterator
     */
    public function __construct($recursiveDirectoryIterator)
    {
        $this->recursiveDirectoryIterator = $recursiveDirectoryIterator;
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
            $this->parsedData[] = Reader::createFromPath($filename)->setHeaderOffset(0);
            File::delete($filename);
        }

        if (empty($this->parsedData)) {
            throw new FileNotFoundException();
        }
        $this->parse();
    }

    protected function parse(): void
    {
        foreach ($this->parsedData as $data) {
            collect($data)->map(function ($csvData) {
                Log::info('Retrieved the data', $csvData);
                $server = Server::whereIn('hostname', [$csvData['hostname']])->first();
                if ($server) {
                    unset($csvData['hostname']);
                    unset($csvData['ipaddress']);
                    $value = $server->addValues($csvData);
                    $value->server->update([
                        'server_time' => $value->created_at,
                    ]);
                } else {
                    return false;
                }
                Log::info('Saved the exported Data');
            });
        }
    }
}
