<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class CreateImage
{
    public function getImage(File $fileinpdf): File
    {
        if ($fileinpdf->getSize() > 0) {
            $process = new Process(['pdftoppm', '-png', '-r', '300',
                $fileinpdf->getPath().'/'.$fileinpdf->getFilename(), sys_get_temp_dir().'/'.$fileinpdf->getBasename('.pdf'), ]);

            $process->run();
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return new File(sys_get_temp_dir().'/'.$fileinpdf->getBasename('.pdf').'-1.png');
        } else {
            throw new FileNotFoundException($fileinpdf);
        }
    }
}
