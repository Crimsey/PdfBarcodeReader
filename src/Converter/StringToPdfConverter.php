<?php

// src/Converter/StringToPdfConverter.php

declare(strict_types=1);

namespace App\Converter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
//use Symfony\Component\Validator\Constraints as Assert;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class StringToPdfConverter implements ParamConverterInterface
{
    public function apply(Request $request, ParamConverter $configuration): bool
    {
        //public File $myfile = null;
        //$stringfile = $_POST['myfile'];

        /*if (null === $stringfile) {
            throw new BadRequestHttpException('File not provided');
        }*/
        /*else {
            if ($stringfile === base64_decode($stringfile, true)) {
                echo '$myfile is base64';

                }
            } else {
                echo '$myfile is NOT base64';

            }*/

        $options = $configuration->getOptions();

        /*$options = $configuration->getOptions();

        $identifier = $this->getVatNumber($request, $options);
        if ($identifier === null) {
            throw new BadRequestHttpException('Identifier not provided in request.');
        }

        if (!VatNumber::isValid($identifier)) {
            throw new BadRequestHttpException(sprintf('Nip %s is not valid', $identifier));
        }

        $request->attributes->set($configuration->getName(), VatNumber::fromString($identifier));
*/
        return true;
    }

    public function supports(ParamConverter $configuration): bool
    {
        /*if (null === $configuration->getClass()) {
            return false;
        }

        if (VatNumber::class !== $configuration->getClass()) {
            return false;
        }*/

        return true;
    }

    /*/**
     * @param Request $request
     * @param array   $options
     *
     * @return string|null
     */
    /*private function getVatNumber(Request $request, array $options): ?string
    {
        if (isset($options['vat_number']) && !$request->attributes->has($options['vat_number'])) {
            return $options['vat_number'];
        }

        if ($request->attributes->has('vat_number') && !isset($options['vat_number'])) {
            return $request->attributes->get('vat_number');
        }

        return null;
    }*/
    /*private function getFile(Request $request, array $options) : File
    {
        return
    }*/
}
