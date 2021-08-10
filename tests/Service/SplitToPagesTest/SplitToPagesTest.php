<?php

// tests/Service/CreateImageTest.php

namespace App\Tests\Service\SplitToPagesTest;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

class SplitToPagesTest extends KernelTestCase
{
    public function testSomething(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $this->assertDirectoryExists('tests/Service/SplitToPagesTest/Files', "Directory 'tests/Service/CreateImageTest/Files exists");

        $splitfile = new File(__DIR__.'/Files/nowy.pdf');

        $filesystem = new Filesystem();
        //delete file after test
        if (false !== $splitfile->getRealPath()) {
            $filesystem->remove(__DIR__.'/Files/nowy-1.pdf');
            $filesystem->remove(__DIR__.'/Files/nowy-2.pdf');
            $filesystem->remove(__DIR__.'/Files/nowy-3.pdf');
            $filesystem->remove(__DIR__.'/Files/nowy-4.pdf');
            $filesystem->remove(__DIR__.'/Files/nowy-5.pdf');
        }
    }
}
