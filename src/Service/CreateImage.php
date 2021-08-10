<?php

namespace App\Service;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class CreateImage
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function getImage(File $fileinpdf, int $page): File
    {
        if ($fileinpdf->getSize() > 0) {
            $process = new Process(['pdftoppm', '-png', '-r', '300',
                $fileinpdf->getPath().'/'.$fileinpdf->getFilename(), sys_get_temp_dir().'/'.$fileinpdf->getBasename('.pdf'), ]);

            $process->run();
            $image_error = $process->getErrorOutput();

            if (!$process->isSuccessful()) {
                if (str_contains($image_error, 'May not be a PDF file')) {
                    $this->logger->info('May not be a PDF file');
                } else {
                    throw new ProcessFailedException($process);
                }
            }

            return new File(sprintf(sys_get_temp_dir().'/'.$fileinpdf->getBasename('.pdf').'-%d.png', $page));
        } else {
            throw new FileNotFoundException($fileinpdf);
        }
    }
}
