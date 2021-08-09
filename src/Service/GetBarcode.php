<?php

namespace App\Service;

    use Symfony\Component\HttpFoundation\File\File;
    use Symfony\Component\Process\Exception\ProcessFailedException;
    use Symfony\Component\Process\Process;

    class GetBarcode
    {
        public function getBarcode(File $imagefile): array
        {
            $process = new Process(['zbarimg', $imagefile->getRealPath()]);

            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
            $barcode = $process->getOutput();
            $barcode = rtrim($barcode, "\n\r\t\v\0");
            $pieces = explode("\n", $barcode);
            $newArray = [] ?? '';
            foreach ($pieces as $lineNum => $line) {
                $line = trim($line);
                list($key, $value) = explode(':', $line, 2);
                $newArray[$key][] = $value;
            }

            return $newArray;
        }
    }
