<?php

namespace App\Console\Commands;

use App\Support\CsvReader;
use Illuminate\Console\Command;

class ParseCsvFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parses the csv file';

    public function handle()
    {
        try {
            app(CsvReader::class)->import();
            $this->info('Csv Parsed Successfully');
        } catch (\Exception $e) {
            $this->info($e->getMessage());
        }
    }
}
