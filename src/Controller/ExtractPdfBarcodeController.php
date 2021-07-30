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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\GetBarcode;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ExtractPdfBarcodeController extends AbstractController
{
    private CreateImage $createImage;
    private  GetBarcode $getBarcode;
    public function  __construct(CreateImage $createImage,GetBarcode $getBarcode)
    {
        $this->createImage = $createImage;
        $this->getBarcode = $getBarcode;

    }
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

    public function extract(File $pdffile, CreateImage $createImage, GetBarcode $getBarcode): JsonResponse
    {
        $fileinpdf = new File($pdffile);
        //var_dump('$file: '.$file);
        //$this->container->getParameter('process');

        $jpeg = $createImage->getImage($fileinpdf);
        var_dump('$jestesmy tu: '.$jpeg);

        $barcode = $getBarcode->getBarocde($jpeg);
        var_dump('barcode: '.$barcode);

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
        return new JsonResponse(
            [0,1,1]
        );
    }
}
