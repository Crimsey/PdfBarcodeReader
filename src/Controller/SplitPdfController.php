<?php

// src/Controller/ExtractPdfBarcodeController.php

namespace App\Controller;

//use App\Controller\AbstractAPIController;
//use Swagger\Annotations as SWG;
use _PHPStan_8f2e45ccf\Composer\XdebugHandler\Process;
use OpenApi\Annotations as OA;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfParser\StreamReader;
use setasign\Fpdi\PdfReader\PdfReaderException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use function _PHPStan_8f2e45ccf\RingCentral\Psr7\parse_query;


class SplitPdfController extends AbstractController
{
    /**
     * Parse a PDF file and extract the table of barcodes.
     *
     * @Route("/api/doc/splitpdfbarcode", methods={"POST"})
     *
     * @OA\Parameter(
     *     name="myfile",
     *     in="query",
     *     description="PDF",
     *     required=true,
     *     @OA\Schema(
     *             type="string"
     *     )
     * )
     *
     * @OA\Response (
     *     response=201,
     *     description="elo",
     *     @OA\JsonContent(
     *     type="array",
     *     @OA\Items(
     *     type="string",
     *     enum = {"answer", "testing", "my","array"}
     * )
     * )
     * )
     *
     * @ParamConverter(name="myfile", converter="string_to_file_converter")
     *
     * @OA\Response (
     *     response=401,
     *     description="nope",
     * )
     * @throws PdfParserException
     * @throws PdfReaderException
     */

    public function splitting(File $myfile): JsonResponse
    {
       //$pdf = $_GET['pdf'];
       //var_dump('$variable: '.$pdf);

        $myprocess = new \Symfony\Component\Process\Process(['gs \
                                -o repaired.pdf \
                                -sDEVICE=pdfwrite \
                                -dPDFSETTINGS=/prepress \
                                 corrupted.pdf']);


        $fpdi = new Fpdi();

        var_dump('/tmp/ $pdf->getFilename(): /tmp/'.$myfile->getFilename());
        $pageCount = $fpdi->setSourceFile('/tmp/'.$myfile->getFilename());

        //@throws PdfParserException|PdfReaderException
        // initiate FPDI
        //$pdf = new Fpdi();

        // get the page count
        //$pageCount = $pdf->setSourceFile('/tmp/Sokol6107a19a28bd08.59446405.pdf');

        // iterate through all pages
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            // import a page
            $templateId = $fpdi->importPage($pageNo);

            $fpdi->AddPage();
            // use the imported page and adjust the page size
            $fpdi->useTemplate($templateId, ['adjustPageSize' => true]);

            $fpdi->SetFont('Helvetica');
            $fpdi->SetXY(5, 5);
            $fpdi->Write(8, 'A complete document imported with FPDI');
        }

        // Output the new PDF
        $fpdi->Output();


        return new JsonResponse(
            [0, 1, 1]
        );
    }


}
