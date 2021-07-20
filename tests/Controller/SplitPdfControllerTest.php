<?php

// tests/Controller/SplitPdfControllerTest.php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SplitPdfControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();

        // Request a specific page
        $crawler = $client->request('POST', '/api/doc/splitpdfbarcode');
        $response = $client->getResponse();
        var_dump($client->getResponse()->getStatusCode() . "- SplitPdfControllerTest");
        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('h1', 'Hello World');
    }
}
