<?php

// src/Controller/ExtractPdfBarcodeController.php

namespace App\Controller;

//use App\Controller\AbstractAPIController;
//use Swagger\Annotations as SWG;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExtractPdfBarcodeController
{
    /**
     * Parse a PDF file and extract the table of barcodes.
     *
     * @Route("/api/doc/extractpdfbarcode", methods={"POST"})
     *
     * @OA\Parameter(
     *     name="myfile",
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
     */
    public function extract(): Response
    {
        return new Response(
            '<html><body> POST </body></html>'
        );
    }
}
