<?php

// tests/Service/CreateImageTest.php

namespace App\Tests\Service\SplitToPagesTest;

use App\Service\SplitToPages;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\File\File;

class SplitToPagesTest extends KernelTestCase
{
    public function testSomething(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $this->assertDirectoryExists('tests/Service/SplitToPagesTest/Files', "Directory 'tests/Service/CreateImageTest/Files exists");

        $splitfile = new File(__DIR__.'/Files/nowy.pdf');

        ///** @var SplitToPages $pages */
        //$pages = $container->get(SplitToPages::class);

        //checks directory

        //$splitFunction = $pages->split($splitfile);

        //checks created png file

        //delete file after test
        if (false !== glob('/tmp/*.png') && false !== glob('/tmp/*.pdf')) {
            array_map('unlink', glob('/tmp/*.png'));
            array_map('unlink', glob('/tmp/*.pdf'));
        }
    }
}
