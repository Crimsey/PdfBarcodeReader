<?php
namespace  App\Service;
use Symfony\Component\Process\Process;

class CreateImage
{
    public function  getImage(): array
    {

        //$process = new Process('pdftoppm -f 1 -r 300 -jpeg quality=100 '.$file);

        //$process = new Process('pdftoppm','-f 1 -r 300 -jpeg quality=100',$file);
        return  [0,1];
    }
}
