<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class CreateImage
{
    public function getImage(File $fileinpdf, int $pages = 1): File
    {
        if ($fileinpdf->getSize() > 0) {
            $process = new Process(['pdftoppm', '-png', '-r', '300',
                $fileinpdf->getPath().'/'.$fileinpdf->getFilename(), sys_get_temp_dir().'/'.$fileinpdf->getBasename('.pdf'), ]);

            $process->run();
            $image_error = $process->getErrorOutput();

            if (!$process->isSuccessful()) {
                if (false != strpos($image_error, 'May not be a PDF file')) {
                    echo 'May not be a PDF file'.PHP_EOL;
                } else {
                    throw new ProcessFailedException($process);
                }
            }

            return new File(sprintf(sys_get_temp_dir().'/'.$fileinpdf->getBasename('.pdf').'-%d.png', $pages));
        } else {
            throw new FileNotFoundException($fileinpdf);
        }
    }
}
