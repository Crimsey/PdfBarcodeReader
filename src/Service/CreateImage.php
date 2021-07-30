<?php
namespace  App\Service;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;


class CreateImage
{
   /*private File $fileinpdf;

    public function __construct(File $fileinpdf)
    {
        $this->fileinpdf=$fileinpdf;
    }*/

    /*private ParameterBagInterface $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }*/


    public function  getImage(File $fileinpdf): File
    {
        $filesystem = new Filesystem();

        $filesystem->chmod($fileinpdf,777);
        //$process = new Process(['pdftoppm','f -1', '-png', $fileinpdf->getFilename(),$fileinpdf->getBasename('.pdf')],'/tmp');
        $process = new Process(['pdftoppm','-png', $fileinpdf->getFilename(),$fileinpdf->getBasename('.pdf')],'/tmp');

        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        //$process = new Process('pdftoppm','-f 1 -r 300 -jpeg quality=100',$file);
        //return new Process(['pdftoppm -f 1 -r 300 -jpeg quality=100 '.$fileinpdf]);
        //file_put_contents(sys_get_temp_dir().'/'.$fileinpdf->getBasename('.pdf'),$process->getOutput());
        //return $process->getOutput();
        //return true;
        return new File(sys_get_temp_dir().'/'.$fileinpdf->getBasename('.pdf').'-1.png');
    }
}
