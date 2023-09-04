<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    // #[Route('/post', name: 'app_post')]
    // public function index(): JsonResponse
    // {
    //     return $this->json([
    //         'message' => 'Welcome to your new controller!',
    //         'path' => 'src/Controller/PostController.php',
    //     ]);
    // }

    #[Route('/', methods:['GET'], name: 'posts.index')] // to odpowiada stronir głównej
    public function inex() : Response
    {
        return new Response(
            "<h1>Lista wszystkich postów!</h1>" .
            "<p>Nazwa route'a użyta w tym widoku:    " .
            $this->generateUrl('posts.index') .  "</p>"
        );
    }

    // Za pomocą tego rout'a wyciągniemy wszystkie posty ale konkretnego użytkownika (konkretne ID)
    #[Route('/posts/user/{id}' , methods: ['GET'] , name: 'posts.user')]
    public function user(int $id) : Response
    {
        return new Response(
            '<h1>Lista wszystkich postów konkretnego użytkownika</h1>' .
            'User id: ' . $id . '<br' .
            'Named route that we will use in the view: ' .
            $this->generateUrl('posts.user' , ['id' => $id])
        );
    }

    // Za pomoca tego route'a będziemy przełączali czy użytkownika śledzimy czy nie
    #[Route('/toggleFollow/{user}' , methods: ['GET'] , name: 'toggleFollow')]
    public function toggleFollow($user) : Response
    {
        return new Response(
            '<h1>Toggle like/dislike</h1>' .
            '<p>User id: ' . $user . '</br>' .
            $this->generateUrl('toggleFollow' , ['user' => $user]) . '</p>');

    }
}
