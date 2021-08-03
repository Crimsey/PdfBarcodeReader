<?php

// src/Converter/StringToPdfConverter.php

declare(strict_types=1);

namespace App\ParamConverters;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Process\Process;

//use JMS\SerializerBundle\Serializer\SerializerInterface;

class StringToPdfConverter implements ParamConverterInterface
{
    public function apply(Request $request, ParamConverter $configuration): bool
    {
        $myfile = $request->query->get('myfile');
        $filename = uniqid('Sokol', true).'.pdf';

        if (null !== $myfile) {
            $file_decoded = base64_decode(strval($myfile));
            var_dump('$file_decoded: '.$file_decoded);
            //var_dump('$filename: '.$filename);
            file_put_contents(sys_get_temp_dir().'/'.$filename, $file_decoded);
            $fileinpdf = new File(sys_get_temp_dir().'/'.$filename);

            //$myprocess = new Process(['gs -o repaired.pdf -sDEVICE=pdfwrite -dPDFSETTINGS=/prepress corrupted.pdf'],'/tmp');

            $request->attributes->set($configuration->getName(), $fileinpdf);
        } else {
            file_put_contents(sys_get_temp_dir().'/'.$filename, '');

            $request->attributes->set($configuration->getName(), new File(sys_get_temp_dir().'/'.$filename));
            //return false;
        }

        return true;
    }

    public function supports(ParamConverter $configuration)
    {
        return File::class === $configuration->getClass();
    }
}
