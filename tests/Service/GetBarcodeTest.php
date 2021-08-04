<?php

// tests/Service/GetBarcodeTest.php

namespace App\Tests\Service;

use App\Service\GetBarcode;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\File\File;

class GetBarcodeTest extends KernelTestCase
{
    public function testSomething(): void
    {
        // (1) boot the Symfony kernel
        self::bootKernel();

        // (2) use static::getContainer() to access the service container
        $container = static::getContainer();

        // (3) run some service & test the result
        $getBarcode = $container->get(GetBarcode::class);
        //$barcode = $getBarcode->getBarcode(File $imagefile);
        //$this->assertEquals( ,$barcode->getContent());
        //$newsletter = $newsletterGenerator->generateMonthlyNews(...);

        //$this->assertEquals(..., $newsletter->getContent());
    }


}
