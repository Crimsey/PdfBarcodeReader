<?php

// src/Controller/ExtractPdfBarcodeController.php

namespace App\Controller;

//use App\Controller\AbstractAPIController;
//use Swagger\Annotations as SWG;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SplitPdfController
{
    /**
     * Split PDF file, regarding the table of barcodes.
     *
     * @Route("/api/doc/splitpdfbarcode", methods={"POST"})
     *
     * @OA\Parameter(
     *     name="BarcodeTable",
     *     in="path",
     *     description="Table of barcodes",
     *     required=true,
     *      @OA\Schema(
     *             type="array",
     *             @OA\Items(
     *              type="string",
     *              enum = {"question", "testing", "my","array"}
     *         )
     *      )
     * )
     *
     * @OA\RequestBody(
     *     description="Parse the table of barcodes",
     *     @OA\MediaType(
     *      mediaType="application/json",
     *     @OA\Schema(
     *     type="array",
     *     @OA\Items(
     *     type="string",
     *     enum = {"answer", "testing", "my","array"}
     * )
     * )
     * )
     * )
     *
     * @OA\Response (
     *     response=200,
     *     description="You have just splitted a PDF file",
     *    @OA\MediaType(
     *      mediaType="application/octet-stream",
     *     @OA\Schema(
     *       type="string",
     *       format="base64"
     *      )
     * )
     * )
     */
    public function split(): Response
    {
        return new Response(
            '<html><body> POST </body></html>'
        );
    }
}
