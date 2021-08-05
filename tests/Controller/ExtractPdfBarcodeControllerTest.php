<?php

// tests/Controller/ExtractPdfBarcodeControllerTest.php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExtractPdfBarcodeControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/api/doc/extractpdfbarcode');
        var_dump($client->getResponse()->getStatusCode().'- ExtractPdfBarcodeControllerTest');

        $this->assertResponseIsSuccessful('200 - ExtractPdfBarcodeControllerTest');
        $crawler->selectButton('try-out__btn');


    }


}
