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
     * Extract the barcode from PDF(GET).
     *
     * @Route("/api/doc/extractpdfbarcode", methods={"GET"})
     *
     * @OA\Response(
     *     response=200,
     *     description="Returned barcode/s from PDF"
     *)
     * @OA\Parameter(
     *     name="operationId",
     *     in="query",
     *     @OA\Schema(type="integer"),
     *     @OA\Schema(format="int64"),
     *     description="Single operation of extracting Barcode from PDF",
     *     required=true
     * )
     *
     * @OA\Parameter(
     *     name="pdf_file",
     *     in="header",
     *     @OA\Schema(type="object"),
     *     description="File in pdf format",
     *     required=true
     * )
     * @OA\Parameter(
     *     name="jpeg_file",
     *     in="header",
     *     @OA\Schema(type="object"),
     *     description="File in jpeg format",
     *     required=true
     * )
     * @OA\Parameter(
     *     name="counter",
     *     in="header",
     *     @OA\Schema(type="integer"),
     *     description="Counter of barcodes on single page",
     *     required=true
     * )
     * @OA\Parameter(
     *     name="barcode_type",
     *     in="header",
     *     @OA\Schema(type="integer"),
     *     description="Type of barcode",
     *     required=true
     * )
     * @OA\Parameter(
     *     name="barcode",
     *     in="header",
     *     @OA\Schema(type="string"),
     *     @OA\Schema(format="byte"),
     *     description="Barcode in string format",
     *     required=true
     * )
     *
     */
    public function test(): Response
    {
        return new Response(
            '<html><body> ExtractPdfBarcodeController </body></html>'
        );
    }

    /**
     * Extract the barcode from PDF(GET).
     *
     * @Route("/api/doc/extractpdfbarcodePOST", methods={"POST"})
     *
     */
    public function post(): Response
    {
        return new Response(
            '<html><body> POST </body></html>'
        );
    }
}
