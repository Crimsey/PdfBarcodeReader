<?php

namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class CreateImage
{
    public function getImage(File $fileinpdf): File
    {
        if ($fileinpdf->getSize() > 0) {
            $filesystem = new Filesystem();

            $filesystem->chmod($fileinpdf, 777);
            //$process = new Process(['pdftoppm','f -1', '-png', $fileinpdf->getFilename(),$fileinpdf->getBasename('.pdf')],'/tmp');
            $process = new Process(['pdftoppm', '-png', $fileinpdf->getFilename(), $fileinpdf->getBasename('.pdf')], '/tmp');

            $process->run();
            //var_dump('cokolwiek: ',$process->getOutput());
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
            //$process = new Process('pdftoppm','-f 1 -r 300 -jpeg quality=100',$file);
            //return new Process(['pdftoppm -f 1 -r 300 -jpeg quality=100 '.$fileinpdf]);
            //file_put_contents(sys_get_temp_dir().'/'.$fileinpdf->getBasename('.pdf'),$process->getOutput());
            //return $process->getOutput();
            //return true;
            return new File(sys_get_temp_dir().'/'.$fileinpdf->getBasename('.pdf').'-1.png');
        } else {
            throw new FileNotFoundException($fileinpdf);
        }
    }
}
