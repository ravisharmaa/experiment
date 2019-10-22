<?php

namespace Tests\Feature;

use App\Server;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreCsvTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_stores_csv_through_artisan_command()
    {

        $file = fopen(public_path('home/edelman/file.csv'), 'w');
        fputcsv($file, ['hostname', 'ipaddress', 'systemuptime', 'memtotal', 'memfree']);

        $data = [
            ['example.com', '1.1.1.1', '200days', '1452', '5223'],
        ];

        foreach ($data as $row) {
            fputcsv($file, $row);
        }

        fclose($file);

        $server = factory(Server::class)->state('specific_host_for_csv')->create();

        $this->artisan('parse:csv');

        $this->assertDatabaseHas('values', [
           'server_id' => $server->id,
            'memtotal' => $data[0][3]
        ]);


        $this->assertSame('200days', $server->values()->first()->systemuptime);

        $this->assertFileNotExists(public_path('home/edelman/file.csv'));
    }
}
