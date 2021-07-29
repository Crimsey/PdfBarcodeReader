<?php

// src/Controller/ExtractPdfBarcodeController.php

namespace App\Controller;

//use App\Controller\AbstractAPIController;
//use Swagger\Annotations as SWG;
use App\Service\CreateImage;
use http\Exception\InvalidArgumentException;
use OpenApi\Annotations as OA;
use OpenApi\Annotations\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\GetBarcode;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ExtractPdfBarcodeController
{
    /*private ContainerInterface $container;

    public function __construct(ContainerInterface $container) // <- Add this
    {
        $this->container = $container;
    }*/

    /**
     * Parse a PDF file and extract the table of barcodes.
     *
     * @Route("/api/doc/extractpdfbarcode", methods={"POST"})
     *
     * @OA\Parameter(
     *     name="myfile",
     *     in="query",
     *     description="PDF file with one/multiple barcodes",
     *     required=true,
     *     @OA\Schema(
     *             type="string"
     *     )
     * )
     *
     * @OA\Response (
     *     response=200,
     *     description="You have just parsed a PDF file",
     *     @OA\JsonContent(
     *     type="array",
     *     @OA\Items(
     *     type="string",
     *     enum = {"answer", "testing", "my","array"}
     * )
     * )
     * )
     *
     * @OA\Response (
     *     response=400,
     *     description="This is not a PDF file",
     * )
     * @ParamConverter(name="pdffile", converter="string_to_file_converter")
     */
    //private  CreateImage $createImage;

    public function extract(File $pdffile): Response
    {
        $fileinpdf = new File($pdffile);
        //var_dump('$file: '.$file);
        //$this->container->getParameter('process');

        //$createImage->getImage($file);
        //var_dump($createImage);
        //$createImage->g

        /*if($myfile === null) {
            throw new BadRequestHttpException('File not provided');
        }
        if($myfile === base64_decode($myfile, true)){
            echo '$myfile is base64';
        } else{
            echo '$myfile is NOT base64';
            throw new InvalidArgumentException('Invalid argument - not base64');
        }
*/
        return new Response(
            '<html><body> POST </body></html>'
        );
    }
}
