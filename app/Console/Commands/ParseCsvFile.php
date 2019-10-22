<?php

namespace App\Console\Commands;

use App\Server;
use App\Support\CsvReader;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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
            $parsedData = app(CsvReader::class)->import();

            foreach ($parsedData as $data) {
                foreach ($data as $csvData) {
                    Log::info('Retrieved the data', $csvData);
                    $server = Server::whereIn('hostname', [$csvData['hostname']])->first();
                    if (!$server) {
                        continue;
                    }
                    unset($csvData['hostname']);
                    unset($csvData['ipaddress']);
                    $value = $server->addValues($csvData);
                    $value->server->update([
                        'server_time' => $value->created_at,
                    ]);

                    Log::info('Saved the exported Data');
                    $this->info("Csv Parsed Successfully");
                }
            }
        } catch (\Exception $e) {
             dd($e->getMessage());
            $this->info('Could not parse Csv');
        }
    }
}
