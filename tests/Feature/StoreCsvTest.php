<?php

namespace Tests\Feature;

use App\Server;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreCsvTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @param string $fileName
     * @param array $data
     */
    protected function prepareCsvData(string $fileName, array $data ): void
    {
        $file = fopen(public_path("home/{$fileName}"), 'w');
        fputcsv($file, ['hostname', 'ipaddress', 'systemuptime', 'memtotal', 'memfree']);

        foreach ($data as $row) {
            fputcsv($file, $row);
        }

        fclose($file);
    }

    /**
     * @test
     */
    public function it_stores_csv_recursively_through_artisan_command()
    {
        $dataOfServerA = [
            ['example.com', '1.1.1.1', '200days', '1452', '5223'],
        ];

        $this->prepareCsvData('edelman/server_a.csv', $dataOfServerA);

        $dataOfServerB = [
            ['server_b', '1.1.1.1', '205days', '1452', '5223'],
        ];

        $this->prepareCsvData('javra/server_b.csv', $dataOfServerB);

        $serverA = factory(Server::class)->state('specific_host_for_csv')->create();

        $serverB = factory(Server::class)->create([
             'hostname' => 'server_b',
            'ipaddress' => '1.2.2.2'
        ]);

        $this->artisan('parse:csv');

        $this->assertDatabaseHas('values', [
            'server_id' => $serverA->id,
            'memtotal' => $dataOfServerA[0][3]
        ]);

        $this->assertDatabaseHas('values', [
            'server_id' => $serverB->id,
            'memtotal' => $dataOfServerB[0][3]
        ]);



        $this->assertFileNotExists(public_path('home/edelman/server_a.csv'));
        $this->assertFileNotExists(public_path('home/javra/server_b.csv'));
    }
}
