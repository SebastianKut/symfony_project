<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        //   OR
        //return new Response('<h1>Yo</h1>');
        //  OR USE TEMPLATE
        return $this->render( 'home/index.html.twig' );
    }


    //set up route that will have parameter that can be changed dynamically
    /**
     * @Route("/custom/{name?}", name="custom")             //add parameter to route {name} - to make it optional add ? so it looks like this {name?}
     * @param Request
     * @return Response
     */
    
     public function custom( Request $response ) 
     {
        //dump( $response->get('name') ); //similar to var_dump - dump() is symfony function that formats stuff nicely
        $nameFromUrl = $response->get('name');

        //return new Response( '<h1>Welcome '.$name. '!</h1>' );
        //OR USE TWIG
        return $this->render('home/custom.html.twig', [
            'name'  => $nameFromUrl
            ]);
     }

     
}
