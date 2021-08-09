<?php

// src/Controller/ExtractPdfBarcodeController.php

namespace App\Controller;

//use App\Controller\AbstractAPIController;
//use Swagger\Annotations as SWG;
use App\Service\CreateImage;
use App\Service\GetBarcode;
use Hoa\Iterator\FileSystem;
use OpenApi\Annotations as OA;
use OpenApi\Annotations\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Process;
use Symfony\Component\Routing\Annotation\Route;

class ExtractPdfBarcodeController extends AbstractController
{
    /**
     * Parse a PDF file and extract the table of barcodes.
     *
     * @Route("/api/doc/extractpdfbarcode", methods={"POST"})
     *
     * @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               required={"myfile"},
     *               @OA\Property(
     *                   property="myfile",
     *                   description="PDF file with one/multiple barcodes",
     *                   @OA\Schema(
     *                      type="string",
     *                      format="base64"
     *                   )
     *               )
     *           )
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
    public function extract(File $pdffile, CreateImage $createImage, GetBarcode $getBarcode): JsonResponse
    {
        if ($pdffile->getSize() > 0) {
            try {
                $fileinpdf = new File($pdffile);
                $jpeg = $createImage->getImage($fileinpdf);
                $barcode = $getBarcode->getBarcode($jpeg);
                $barcode = rtrim($barcode,"\n\r\t\v\0");
                $pieces = explode("\n", $barcode);
                $newArray =array() ?? "";
                foreach ($pieces as $lineNum => $line)
                {
                    $line = trim($line);
                    list($key,$value) = explode(":",$line,2);
                    $newArray[$key][] = $value;
                }

                //$fileinpdf = new FileSystem();

                return new JsonResponse(

                $newArray
                );
            } catch (FileNotFoundException $fileNotFoundException) {
                echo $fileNotFoundException->getMessage();
            }
        }

        return new JsonResponse(
                ['ERROR']
            );
    }
}
