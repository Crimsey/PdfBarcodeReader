<?php

namespace App\Service;

    use Symfony\Component\HttpFoundation\File\File;
    use Symfony\Component\Process\Exception\ProcessFailedException;
    use Symfony\Component\Process\Process;

    class GetBarcode
    {
        public function getBarcode(File $imagefile): array
        {
            //var_dump('$imagefile->getRealPath(): '.$imagefile->getRealPath());
            $process = Process::fromShellCommandline('zbarimg '.$imagefile->getRealPath());

            $process->run();
            $barcode = $process->getOutput();
            $barcode_error = $process->getErrorOutput();
            $newArray = [];
            if (!$process->isSuccessful()) {
                if (!str_contains($barcode_error, 'scanned 0 barcode symbols')) {
                    throw new ProcessFailedException($process);
                } else {
                    return $newArray;
                }
            } else {
                $process->disableOutput()->clearOutput();

                $barcode = rtrim($barcode, "\n\r\t\v\0");
                $pieces = explode("\n", $barcode);
                foreach ($pieces as $lineNum => $line) {
                    $line = trim($line);
                    list($key, $value) = explode(':', $line, 2);
                    $newArray[$key][] = $value;
                }
            }

            return $newArray;
        }
    }
