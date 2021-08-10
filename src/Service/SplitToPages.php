<?php

namespace App\Service;

use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\PdfParserException;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class SplitToPages
{
    /**
     * @throws PdfParserException
     */
    public function split(File $filetosplit): int
    {
        if (false !== $filetosplit->getRealPath()) {
            $fpdi = new Fpdi();
            /*$process = Process::fromShellCommandline('pdfseparate ' . $filetosplit->getPath() . '/' .
                $filetosplit->getFilename() . ' ' .
                sys_get_temp_dir().'/'.$filetosplit->getFilename().'-%d.pdf');


            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }*/
            return $fpdi->setSourceFile($filetosplit->getRealPath());
        } else {
            throw new FileNotFoundException($filetosplit);
        }
    }
}
