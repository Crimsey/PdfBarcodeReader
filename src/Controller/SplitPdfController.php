<?php

// src/Controller/ExtractPdfBarcodeController.php

namespace App\Controller;

//use App\Controller\AbstractAPIController;
//use Swagger\Annotations as SWG;
use OpenApi\Annotations as OA;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfReader\PdfReaderException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SplitPdfController
{
    /**
     * Parse a PDF file and extract the table of barcodes.
     *
     * @Route("/api/doc/splitpdfbarcode", methods={"POST"})
     *
     * @OA\Parameter(
     *     name="pdf",
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
     * @OA\Response (
     *     response=401,
     *     description="nope",
     * )
     * @throws PdfParserException|PdfReaderException
     */
    public function splitting(): JsonResponse
    {    // initiate FPDI
        $pdf = new Fpdi();

        // get the page count
        $pageCount = $pdf->setSourceFile('/tmp/Sokol6107a19a28bd08.59446405.pdf');

        // iterate through all pages
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            // import a page
            $templateId = $pdf->importPage($pageNo);

            $pdf->AddPage();
            // use the imported page and adjust the page size
            $pdf->useTemplate($templateId, ['adjustPageSize' => true]);

            $pdf->SetFont('Helvetica');
            $pdf->SetXY(5, 5);
            $pdf->Write(8, 'A complete document imported with FPDI');
        }

        // Output the new PDF
        $pdf->Output();

        return new JsonResponse(
            [0, 1, 1]
        );
    }
}
