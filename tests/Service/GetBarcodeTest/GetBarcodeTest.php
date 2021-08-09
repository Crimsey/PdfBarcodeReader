<?php

// tests/Service/GetBarcodeTest.php

namespace App\Tests\Service\GetBarcodeTest;

use App\Service\GetBarcode;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
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

        //var_dump($barcodeFunction);
        $str_to_compare = 'QR-Code:http://barcode4j.sourceforge.net/
EAN-8:01234565
EAN-13:0123456789012
EAN-13:0012300000413
EAN-13:0012345678905
I2/5:0123456789
CODE-128:0101234567890128
CODE-128:0123456789
';
        //checks created string of barcodes
        $this->assertSame($str_to_compare, $barcodeFunction, 'string from zbarimg with barcodes has the same content');
        $this->assertNotNull($barcodeFunction, 'Service GetBarcode returned not null');
        $this->assertIsString($barcodeFunction, 'Service GetBarcode returned string');
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
    }

}
