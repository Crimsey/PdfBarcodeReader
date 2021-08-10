<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class SplitToPages
{
    public function split(File $filetosplit): JsonResponse
    {
        $process = Process::fromShellCommandline('pdfseparate '.$filetosplit->getPath().'/'.
            $filetosplit->getFilename().' '.
        __DIR__.'/nowy-%d.pdf');
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return new JsonResponse(
            [0, 1]
        );
    }
}
