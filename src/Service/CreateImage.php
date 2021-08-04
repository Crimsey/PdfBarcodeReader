<?php

namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;


class CreateImage
{

    public function getImage(File $fileinpdf): File
    {



        if ($fileinpdf->getSize() > 0) {
            //$filesystem = new Filesystem();

            //$filesystem->chmod($fileinpdf, 777);
            $process = new Process(['pdftoppm', '-png', $fileinpdf->getFilename(), $fileinpdf->getBasename('.pdf')], '/tmp');

            $process->run();
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            #Dependency Injection:
            $containerBuilder = new ContainerBuilder();
            $containerBuilder->register('create_image_container','CreateImage')
                ->addMethodCall('getImage');

            $containerBuilder->setParameter('fileinpdf', $fileinpdf);
            var_dump("CreateImage");
            var_dump($fileinpdf);

            return new File(sys_get_temp_dir().'/'.$fileinpdf->getBasename('.pdf').'-1.png');
        } else {
            throw new FileNotFoundException($fileinpdf);
        }
    }
}
