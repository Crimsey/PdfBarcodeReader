<?php

// src/Converter/StringToPdfConverter.php

declare(strict_types=1);

namespace App\ParamConverters;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;

class StringToPdfConverter implements ParamConverterInterface
{
    public function apply(Request $request, ParamConverter $configuration): bool
    {
        $myfile = $request->request->get('myfile');
        $filename = uniqid('Sokol', true).'.pdf';

        if (null !== $myfile && is_string($myfile)) {
            $file_decoded = base64_decode($myfile);

            file_put_contents(sys_get_temp_dir().'/'.$filename, $file_decoded);
            $fileinpdf = new File(sys_get_temp_dir().'/'.$filename);
            $request->attributes->set($configuration->getName(), $fileinpdf);
        } else {
            //pass the empty file with correct name:
            file_put_contents(sys_get_temp_dir().'/'.$filename, '');
            $request->attributes->set($configuration->getName(), new File(sys_get_temp_dir().'/'.$filename));
        }

        return true;
    }

    public function supports(ParamConverter $configuration)
    {
        return File::class === $configuration->getClass();
    }
}
