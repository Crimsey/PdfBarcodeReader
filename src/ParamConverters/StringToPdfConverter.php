<?php

// src/Converter/StringToPdfConverter.php

declare(strict_types=1);

namespace App\ParamConverters;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use setasign\Fpdi\PdfParser\PdfParserException;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Constraints as Assert;

use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
//use JMS\SerializerBundle\Serializer\SerializerInterface;
use Symfony\Component\Serializer\SerializerInterface;


class StringToPdfConverter implements ParamConverterInterface
{

    public function apply(Request $request, ParamConverter $configuration): bool
    {


        $myfile = $request->query->get('myfile');
        $file_decoded=base64_decode(strval($myfile));
        //var_dump('$file_decoded: '.$file_decoded);
        $filename = uniqid('Sokol', true) . '.pdf';
        //var_dump('$filename: '.$filename);
        file_put_contents(sys_get_temp_dir().'/'.$filename,$file_decoded);
        $fileinpdf = new File(sys_get_temp_dir().'/'.$filename);

        //$new = file_put_contents(sys_get_temp_dir().'/'.$filename,$file_decoded);
        //var_dump('C:/Users/jakub.sokol/Desktop'.'/'.'$filename: '.sys_get_temp_dir().'/'.$filename);

        //var_dump('$new: '.$new);
        $request->attributes->set($configuration->getName(),$fileinpdf);

        return true;
    }

    public function supports(ParamConverter $configuration)
    {
        if (null === $configuration->getClass()) {
            return false;
        }

        return $configuration->getClass() === File::class;
    }

}
