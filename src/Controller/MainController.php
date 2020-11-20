<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        // return $this->json([
        //     'message' => 'Welcome to your new controller!'
        // ]);
        return new Response('<h1>Yo</h1>');
    }

    /**
     * @Route("/custom", name="custom")
     */
    
     public function custom() 
     {

        return new Response( 'This is custom page' );
     }


}
