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

    public function getImage(File $fileinpdf,string $path='/tmp'): File
    {
        if ($fileinpdf->getSize() > 0) {
            //$filesystem = new Filesystem();

            //$filesystem->chmod($fileinpdf, 777);
            $process = new Process(['pdftoppm', '-png', $fileinpdf->getFilename(), $fileinpdf->getBasename('.pdf')], $path);

            $process->run();
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return new File($path.'/'.$fileinpdf->getBasename('.pdf').'-1.png');
        } else {
            throw new FileNotFoundException($fileinpdf);
        }
    }
}
