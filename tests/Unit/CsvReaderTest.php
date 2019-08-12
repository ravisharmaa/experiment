<?php

namespace Tests\Unit;

use App\Support\CsvReader;
use Illuminate\Support\Facades\Storage;
use League\Csv\Exception;
use Tests\TestCase;
use Zend\Diactoros\UploadedFile;

class CsvReaderTest extends TestCase
{
    /**
     * @test
     * @expectedException \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function it_throws_exception_if_no_csv_file_is_found()
    {
        $this->withExceptionHandling();

        $directoryIterator = new \RecursiveDirectoryIterator(public_path('home'));

        $csvReader = new CsvReader($directoryIterator);

        $csvReader->import();
    }

    /**
     * @test
     * @expectedException  Exception
     */

    public function it_throws_exception_if_csv_has_no_content_or_ill_formed()
    {
        $this->withExceptionHandling();

        $directoryIterator = new \RecursiveDirectoryIterator(public_path('home'));

        $csvReader = new CsvReader($directoryIterator);

        $csvReader->import();
    }

    /**
     * @test
     */

    public function it_deletes_the_csv_files_after_processing()
    {
        Storage::fake('public');
        UploadedFile::fake()->create('test.csv');

        $directoryIterator = new \RecursiveDirectoryIterator(public_path('home'));
        $csvReader = new CsvReader($directoryIterator);

        $csvReader->import();
    }
}
