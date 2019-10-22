<?php

namespace Tests\Unit;

use App\Support\CsvReader;
use Illuminate\Filesystem\Filesystem;
use League\Csv\Statement;
use RecursiveDirectoryIterator;
use Tests\TestCase;

class ReaderTest extends TestCase
{
    private $tempDir;

    /**
     * @var RecursiveDirectoryIterator
     */
    private $directoryIterator;

    /**
     * @var CsvReader
     */
    private $csvReader;

    /**
     * @var Statement
     */
    private $statement;

    protected function setUp()
    {
        $this->tempDir = __DIR__.'/tmp';
        mkdir($this->tempDir);
        $this->directoryIterator = new RecursiveDirectoryIterator($this->tempDir);
        $this->statement = new Statement();
        $this->csvReader = new CsvReader($this->directoryIterator, $this->statement);
        parent::setUp();
    }

    protected function tearDown()
    {
        $files = new Filesystem();
        $files->deleteDirectory($this->tempDir);

        parent::tearDown();
    }

    /**
     * @test
     * @expectedException \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function it_throws_exception_if_csv_not_found()
    {
        $this->csvReader->import();

        $this->assertFileNotExists($this->tempDir.'/temp.csv');
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function it_throws_exception_if_csv_is_ill_formed()
    {
        file_put_contents($this->tempDir.'/file1.csv', '');
        $this->csvReader->import();
    }

    /**
     * @test
     */
    public function it_removes_the_csv_file_after_parsing()
    {
        file_put_contents($this->tempDir.'/file1.csv', 'Hello, World');

        $this->assertDirectoryExists($this->tempDir);

        $this->assertFileExists($this->tempDir.'/file1.csv');

        $this->csvReader->import();

        $this->assertFileNotExists($this->tempDir.'/file1.csv');
    }
}
