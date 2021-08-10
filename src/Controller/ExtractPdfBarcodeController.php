<?php

// src/Controller/ExtractPdfBarcodeController.php

namespace App\Controller;

//use App\Controller\AbstractAPIController;
//use Swagger\Annotations as SWG;
use App\Service\CreateImage;
use App\Service\GetBarcode;
use App\Service\SplitToPages;
use OpenApi\Annotations as OA;
use OpenApi\Annotations\Post;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use setasign\Fpdi\PdfParser\PdfParserException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExtractPdfBarcodeController extends AbstractController
{
    public function __construct(private CreateImage $createImage, private GetBarcode $getBarcode, private LoggerInterface $logger, private SplitToPages $split)
    {
    }

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
     *
     * @throws PdfParserException
     */
    public function extract(File $pdffile): JsonResponse
    {
        $filesystem = new Filesystem();

        if ($pdffile->getSize() > 0) {
            try {
                $fileinpdf = new File($pdffile);
                $pages = $this->split->split($fileinpdf);
                $response = [];
                for ($i = 1; $i <= $pages; ++$i) {
                    $jpeg = $this->createImage->getImage($fileinpdf, $i);
                    $barcode = $this->getBarcode->getBarcode($jpeg);
                    if (false !== $jpeg->getRealPath()) {
                        $filesystem->remove($jpeg->getRealPath());
                   }

                    $response[$i - 1] = $barcode;
                }
                if (false !== $fileinpdf->getRealPath()) {
                    $filesystem->remove($fileinpdf->getRealPath());
                }
                return new JsonResponse(
                    $response
                );
            } catch (FileNotFoundException $fileNotFoundException) {
                $this->logger->alert($fileNotFoundException->getMessage());
            }
        }

        return new JsonResponse(
                []
            );
    }
}
