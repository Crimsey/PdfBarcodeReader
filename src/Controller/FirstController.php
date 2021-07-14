<?php

// src/Controller/FirstController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController
{
    /**
     * @Route ("/firstcontroller", name="first_controller")
     */
    public function hello(): Response
    {
        return new Response(
            '<html><body>Im the first controller </body></html>'
        );
    }
}
