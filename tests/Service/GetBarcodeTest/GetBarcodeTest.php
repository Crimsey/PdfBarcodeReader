<?php

// tests/Service/GetBarcodeTest.php

namespace App\Tests\Service\GetBarcodeTest;

use App\Service\GetBarcode;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\File;

class GetBarcodeTest extends KernelTestCase
{
    public function testSomething(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        /** @var GetBarcode $getBarcode */
        $getBarcode = $container->get(GetBarcode::class);

        //checks directory
        $this->assertDirectoryExists('tests/Service/GetBarcodeTest/Files', "Directory 'tests/Service/GetBarcodeTest/Files exists");
        $this->assertDirectoryIsWritable('tests/Service/GetBarcodeTest/Files', "Directory 'tests/Service/GetBarcodeTest/Files is writeable");

        $testpng = new File(__DIR__.'/Files/Barcode4JReport-1.png');

        //checks png file
        $this->assertFileExists('tests/Service/GetBarcodeTest/Files/Barcode4JReport-1.png', 'Barcode4JReport-1.png exists');
        $this->assertFileIsReadable('tests/Service/GetBarcodeTest/Files/Barcode4JReport-1.png', 'Barcode4JReport-1.png is readable');
        $this->assertNotNull('tests/Service/GetBarcodeTest/Files/Barcode4JReport-1.png', 'File Barcode4JReport-1.png is not null');

        $barcodeFunction = $getBarcode->getBarcode($testpng);

        //checks created array of barcodes
        $this->assertNotNull($barcodeFunction, 'Service GetBarcode returned not null');
        $this->assertIsArray($barcodeFunction, 'Service GetBarcode returned array');
    }

    public function testFileNotFoundException2(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        /** @var GetBarcode $getBarcode */
        $getBarcode = $container->get(GetBarcode::class);

        $this->expectException(FileNotFoundException::class);
        $another = new File('');
        $getBarcode->getBarcode($another);

        $filesystem = new Filesystem();
        if (false !== $another->getRealPath()) {
            $filesystem->remove($another->getRealPath());
        }
    }
}
