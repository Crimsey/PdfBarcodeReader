<?php

// tests/Controller/ExtractPdfBarcodeControllerTest.php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FirstControllerTest extends WebTestCase
{
    public function testFirstControllerResponse(): void
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/firstcontroller');
        $this->assertResponseIsSuccessful('200 - FirstControllerTest');
    }
}
