<?php

// src/Controller/ExtractPdfBarcodeController.php

namespace App\Controller;

//use App\Controller\AbstractAPIController;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExtractPdfBarcodeController //extends AbstractAPIController
{
    /**
     * Extract the barcode from PDF.
     *
     * @Route("/extractpdfbarcode", methods=["GET"])
     *
     */
    public function test(): Response
    {
        return new Response(
            '<html><body> ExtractPdfBarcodeController </body></html>'
        );
    }
}
