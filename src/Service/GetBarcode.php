<?php

namespace App\Service;

    use Symfony\Component\HttpFoundation\File\File;
    use Symfony\Component\Process\Exception\ProcessFailedException;
    use Symfony\Component\Process\Process;

    class GetBarcode
    {
        public function getBarocde(File $imagefile): string
        {
            $process = new Process(['zbarimg', $imagefile->getFilename()], '/tmp');

            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
            var_dump($process->getOutput());

            return $process->getOutput();
        }
    }
