<?php

// src/Controller/ExtractPdfBarcodeController.php

namespace App\Controller;

//use App\Controller\AbstractAPIController;
//use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class ExtractPdfBarcodeController
{
    /**
     * Parse a PDF file and extract the table of barcodes.
     *
     * @Route("/api/doc/extractpdfbarcodePOST", methods={"POST"})
     *
     * @OA\Parameter(
     *     name="PDF file",
     *     in="path",
     *     description="PDF file with one/multiple barcodes",
     *     required=true,
     *      @OA\Schema(
     *             type="string",
     *             format="base64",
     *         )
     * )
     *
     * @OA\RequestBody(
     *     description="Upload PDF file",
     *     @OA\MediaType(
     *      mediaType="application/octet-stream",
     *     @OA\Schema(
     *       type="string",
     *       format="base64"
     *      )
     * )
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
     *
     * )
     * )
     * )
     *
     * @OA\Response (
     *     response=400,
     *     description="This is not a PDF file",
     * )
     *
     *
     */
    public function post(): Response
    {
        return new Response(
            '<html><body> POST </body></html>'
        );
    }

    /**
     * Extract the barcode from PDF(GET).
     *
     *
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


}
