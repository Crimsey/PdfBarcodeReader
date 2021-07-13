<?php
// src/Controller/SecondController.php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;

class SecondController
     {
         public function hello2(): Response
         {
             return new Response(
                 '<html><body>Im the second controller </body></html>'
             );
         }
     }
