<?php

// tests/Service/CreateImageTest.php

namespace App\Tests\Service;

use Symfony\Component\Filesystem\Filesystem;
use App\Service\CreateImage;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\File;

class CreateImageTest extends KernelTestCase
{
    public function testSomething(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        /** @var  CreateImage $createImage */
        $createImage = $container->get(CreateImage::class);

        //checks directory
        $this->assertDirectoryExists('tests/Files/',"Directory 'test/Files/ exists");
        $this->assertDirectoryIsWritable('tests/Files/',"Directory 'test/Files/ is writeable");

        $testfile = new File('tests/Files/Barcode4JReport.pdf');
        //checks pdf file
        $this->assertFileExists($testfile,"File Barcode4JReport.pdf exists");
        $this->assertNotNull($testfile, "File Barcode4JReport.pdf is not null");
        $this->assertIsObject($testfile, 'File Barcode4JReport.pdf is object');

        $imageFunction = $createImage->getImage($testfile,'tests/Files');

        //checks created png file
        $this->assertSame('Barcode4JReport-1.png',$imageFunction->getBasename(),"Barcode4JReport-1.png has the same name");
        $this->assertSame(65487,$imageFunction->getSize(),"Barcode4JReport-1.png has the same size (65487)");
        $this->assertFileExists('tests/Files/Barcode4JReport-1.png','Barcode4JReport-1.png exists');
        $this->assertFileIsReadable('tests/Files/Barcode4JReport-1.png','Barcode4JReport-1.png is readable');
        $this->assertNotNull('tests/Files/Barcode4JReport-1.png', "File Barcode4JReport-1.png is not null");
    }


}
