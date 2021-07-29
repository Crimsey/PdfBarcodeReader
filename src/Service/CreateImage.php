<?php
namespace  App\Service;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Process\Process;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class CreateImage
{
   /*private File $fileinpdf;

    public function __construct(File $fileinpdf)
    {
        $this->fileinpdf=$fileinpdf;
    }*/

    private ParameterBagInterface $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }


    public function  getImage(): Process
    {
        $fileinpdf = strval($this->params->get('myfile'));

        $process = new Process(['pdftoppm -f 1 -r 300 -jpeg quality=100 '.$fileinpdf]);
        //$process = new Process('pdftoppm','-f 1 -r 300 -jpeg quality=100',$file);
        //return new Process(['pdftoppm -f 1 -r 300 -jpeg quality=100 '.$fileinpdf]);
        return $process;
    }
}
