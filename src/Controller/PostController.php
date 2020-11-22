<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/post", name="post.")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    //INDEX action to return data from Post we have to use PostRepository.php
    //this was created with Post.php when we used make:entity
    public function index(PostRepository $postRepository): Response
    {

        $posts = $postRepository->findAll();

        //dump($posts);

        return $this->render('post/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/create", name="create")
     */

    // create custom action called create to insert data into db
    public function create(Request $request)
    {
        //create instance of our Post.php class
        $post = new Post();

        //set a title to be inserted to db
        $post->setTitle('This is a new title');

        //get entity  manager from getDoctrine method inherited from AbstractControler class
        $em = $this->getDoctrine()->getManager();

        //SEND DATA TO DB USING PERSIST
        $em->persist($post);
        //IMPORTANT - after PERSIST use flush()
        $em->flush();

        //add flash message
        $this->addFlash('success', 'Post was created');

        //then we can return new respponse OR redirect 
        //return new Response('Post was created');
        return $this->redirect($this->generateUrl('post.index'));

    }


    /**
     * @Route("/show/{id}", name="show")
     */
    public function show(Post $post)  //We use param convert. This will pass {id} to $post and will return the correct object
    //you have to add sensio to use this " composer require sensio/framework-extra-bundle"
    {
        //create the show post view
        return $this->render('post/show.html.twig', [
            'post'  => $post
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function remove(Post $post)
    {
        //to remove we need to use remove function from entity manager
        $em = $this->getDoctrine()->getManager();

        //remove and flush
        $em->remove($post);
        $em->flush();

        //we can add flash message that uses SESSION to display success messsage
        $this->addFlash('success', 'Post was removed'); //we pass (type, message)


        //redirect back to index
        return $this->redirect($this->generateUrl('post.index'));
    }

}
