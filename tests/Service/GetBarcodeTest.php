<?php

// tests/Service/GetBarcodeTest.php

namespace App\Tests\Service;

use App\Service\CreateImage;
use App\Service\GetBarcode;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\File\File;

class GetBarcodeTest extends KernelTestCase
{
    public function testSomething(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        /** @var  GetBarcode $getBarcode */
        $getBarcode = $container->get(GetBarcode::class);

        //checks directory
        $this->assertDirectoryExists('tests/Files/',"Directory 'test/Files/ exists");
        $this->assertDirectoryIsWritable('tests/Files/',"Directory 'test/Files/ is writeable");

        $testpng= new File('tests/Files/Barcode4JReport-1.png');

        //checks png file
        $this->assertFileExists('tests/Files/Barcode4JReport-1.png','Barcode4JReport-1.png exists');
        $this->assertFileIsReadable('tests/Files/Barcode4JReport-1.png','Barcode4JReport-1.png is readable');
        $this->assertNotNull('tests/Files/Barcode4JReport-1.png', "File Barcode4JReport-1.png is not null");

        $barcodeFunction = $getBarcode->getBarcode($testpng,'tests/Files');

        //var_dump($barcodeFunction);
$str_to_compare = "QR-Code:http://barcode4j.sourceforge.net/
EAN-8:01234565
EAN-13:0123456789012
EAN-13:0012300000413
EAN-13:0012345678905
I2/5:0123456789
CODE-128:0101234567890128
CODE-128:0123456789
";

        //checks created string of barcodes
        $this->assertSame($str_to_compare,$barcodeFunction,"string from zbarimg with barcodes has the same content");
        $this->assertNotNull($barcodeFunction, "Service GetBarcode returned not null");
        $this->assertIsString($barcodeFunction, "Service GetBarcode returned string");



    }
}
