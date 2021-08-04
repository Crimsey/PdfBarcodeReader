<?php

// tests/Service/CreateImageTest.php

namespace App\Tests\Service;

use App\Service\CreateImage;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\File\File;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class CreateImageTest extends KernelTestCase
{
    public function testSomething(): void
    {
        // (1) boot the Symfony kernel
        self::bootKernel();

        // (2) use static::getContainer() to access the service container
        $container = static::getContainer();

        // (3) run some service & test the result
        $createImage = $container->get('create_image_container');
        var_dump($createImage);

        $fileinpdf = $container->getParameter('fileinpdf');
        var_dump($fileinpdf);

        //$image = $createImage->getImage($fileinpdf);
        //$this->assertEquals(..., $newsletter->getContent());
    }


}
