<?php

// tests/Service/CreateImageTest.php

namespace App\Tests\Service\CreateImageTest;

use App\Service\CreateImage;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\File;

class CreateImageTest extends KernelTestCase
{
    private LoggerInterface $logger;

    public function testSomething(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        /** @var CreateImage $createImage */
        $createImage = $container->get(CreateImage::class);

        //checks directory
        $this->assertDirectoryExists('tests/Service/CreateImageTest/Files', "Directory 'tests/Service/CreateImageTest/Files exists");
        $this->assertDirectoryIsWritable('tests/Service/CreateImageTest/Files', "Directory 'tests/Service/CreateImageTest/Files is writeable");

        $testfile = new File(__DIR__.'/Files/Barcode4JReport.pdf');
        //checks pdf file
        $this->assertFileExists($testfile, 'File Barcode4JReport.pdf exists');
        $this->assertNotNull($testfile, 'File Barcode4JReport.pdf is not null');
        $this->assertIsObject($testfile, 'File Barcode4JReport.pdf is object');

        $imageFunction = $createImage->getImage($testfile, 1);

        //checks created png file
        $this->assertSame('Barcode4JReport-1.png', $imageFunction->getBasename(), 'Barcode4JReport-1.png has the same name');
        $this->assertSame(146887, $imageFunction->getSize(), 'Barcode4JReport-1.png has the same size (65487)');
        $this->assertFileExists(sys_get_temp_dir().'/Barcode4JReport-1.png', 'Barcode4JReport-1.png exists');
        $this->assertFileIsReadable(sys_get_temp_dir().'/Barcode4JReport-1.png', 'Barcode4JReport-1.png is readable');
        $this->assertNotNull(sys_get_temp_dir().'/Barcode4JReport-1.png', 'File Barcode4JReport-1.png is not null');

        //delete file after test

        $filesystem = new Filesystem();
        $filesystem->remove(sys_get_temp_dir().'/Barcode4JReport-1.png');
    }

    public function testFileNotFoundException(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        /** @var CreateImage $createImage */
        $createImage = $container->get(CreateImage::class);

        $this->expectException(FileNotFoundException::class);
        $another = new File('');

        $createImage->getImage($another, 1);
        $filesystem = new Filesystem();
        if($another->getRealPath() !== false) {
            $filesystem->remove($another->getRealPath());
        }
    }

    /*public function testCreateImageCanBeCreatedFromFile(): void
    {
        $testfile = new File(__DIR__.'/Files/Barcode4JReport.pdf');

        $this->assertInstanceOf(
            File::class,
            (new \App\Service\CreateImage())->getImage($testfile, 1),
            'Variable is of given type - File'
        );
    }*/
}
