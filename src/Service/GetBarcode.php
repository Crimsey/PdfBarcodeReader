<?php
    namespace  App\Service;
    use Symfony\Component\Process\Process;

    class GetBarcode
    {
        public function  getBarocde(): array
        {
            //$process = new Process('zbarimg'.$imagefile);
            return  [0,1];
        }
    }
