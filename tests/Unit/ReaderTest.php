<?php

namespace Tests\Unit;

use App\Support\CsvReader;
use Illuminate\Filesystem\Filesystem;
use Tests\TestCase;

class ReaderTest extends TestCase
{
    private $tempDir;

    protected function setUp()
    {
        $this->tempDir = __DIR__.'/tmp/';
        mkdir($this->tempDir);
    }

    protected function tearDown()
    {
        \Mockery::close();
        $files = new Filesystem();
        $files->deleteDirectories($this->tempDir);
    }

    /**
     * @test
     * @expectedException \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function it_throws_exception_if_csv_not_found()
    {
        $directoryIterator = new \RecursiveDirectoryIterator($this->tempDir);
        $csvReader = new CsvReader($directoryIterator);

        $csvReader->import();

        $this->assertFileNotExists( $this->tempDir.'/temp.csv');
    }

    /**
     * @test
     * @expectedException \League\Csv\Exception
     */
    public function it_throws_exception_if_csv_is_ill_formed()
    {

    }


}
