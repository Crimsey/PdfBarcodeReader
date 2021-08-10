<?php

// src/Controller/FirstController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController
{
    /**
     * @Route ("/firstcontroller", name="first_controller")
     */
    public function hello(File $file): Response
    {
        //$logger->info('message',['cause' => 'in_hurry']);
        //$file = new File('tmp/witam.txt');
        return new Response(
            '<html><body>Im the first controller </body></html>'
        );
    }
}
