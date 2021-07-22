<?php

// tests/Controller/ExtractPdfBarcodeControllerTest.php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExtractPdfBarcodeControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();

        // Request a specific page
        $crawler = $client->request('POST', '/api/doc/extractpdfbarcode');
        var_dump($client->getResponse()->getStatusCode().'- ExtractPdfBarcodeControllerTest');

        // Validate a successful response and some content
        //this->self::assertEquals();
        $this->assertResponseIsSuccessful('200 - ExtractPdfBarcodeControllerTest');
        //$this->assertSelectorTextContains('h1', 'Hello World');
    }
}
