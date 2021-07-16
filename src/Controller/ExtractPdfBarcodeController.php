<?php

// src/Controller/ExtractPdfBarcodeController.php

namespace App\Controller;

//use App\Controller\AbstractAPIController;
//use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class ExtractPdfBarcodeController //extends AbstractAPIController
{
    /**
     * Extract the barcode from PDF.
     *
     * @Route("/api/doc/extractpdfbarcode", methods={"GET"})
     *
     * @OA\Response(
     *     response=200,
     *     description="Returns barcode/s from PDF"
     *)
     * @OA\Parameter(
     *     name="operation_id",
     *     in="query",
     *     type="integer",
     *     format="int64",
     *     description="Single operation of extracting Barcode from PDF",
     *     required="true"
     * )
     * @OA\Parameter(
     *     name="pdf_file",
     *     in="header",
     *     type="object",
     *     description="File in pdf format",
     *     required="true"
     * )
     * @OA\Parameter(
     *     name="jpeg_file",
     *     in="header",
     *     type="object",
     *     description="File in jpeg format",
     *     required="true"
     * )
     * @OA\Parameter(
     *     name="counter",
     *     in="header",
     *     type="integer",
     *     description="Counter of barcodes on single page",
     *     required="true"
     * )
     * @OA\Parameter(
     *     name="barcode_type",
     *     in="header",
     *     type="integer",
     *     description="Type of barcode",
     *     required="true"
     * )
     * @OA\Parameter(
     *     name="barcode",
     *     in="header",
     *     type="string",
     *     description="Barcode in string format",
     *     required="true"
     * )
     */
    public function test(): Response
    {
        return new Response(
            '<html><body> ExtractPdfBarcodeController </body></html>'
        );
    }
}
