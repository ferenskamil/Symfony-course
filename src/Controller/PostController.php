<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/' , requirements: ['_locale' => 'en|pl'])]
class PostController extends AbstractController
{
    #[Route('/{_locale}', methods:['GET'], name: 'posts.index')] // to odpowiada stronir głównej
    public function index(string $_locale = 'en') : Response
    {
        return $this->render('post/index.html.twig');
    }

    // Wczytywanie new.html.twig
    #[Route('/{_locale}/post/new' , methods: ['GET' , 'POST'] , name: 'posts.new')]
    public function new() : Response
    {
        return $this->render('post/new.html.twig');
    }

    // Wyświetlanie szczegółów posta na blogu
    #[Route('/{_locale}/post/{id}/' , methods: ['GET'] , name: 'posts.show')]
    public function show($id) : Response
    {
        return $this->render('post/show.html.twig');
    }

    // Za pomocą tego rout'a wyciągniemy wszystkie posty ale konkretnego użytkownika (konkretne ID)
    #[Route('/posts/user/{id}' , methods: ['GET'] , name: 'posts.user')]
    public function user(int $id) : Response
    {
        return $this->render('post/index.html.twig');
    }

    #[Route('post/{id}/edit' , methods: ['GET'] , name: 'posts.edit')]
    public function edit($id) : Response
    {
        // return $this->redirectToRoute('posts.index');
        return $this->render('post/edit.html.twig');
    }

    #[Route('/post/{id}/delete' , methods: ['POST'] , name: 'posts.delete')]
    public function delete($id) : Response
    {
        return new Response('delete post from the database');
    }

    // Za pomoca tego route'a będziemy przełączali czy użytkownika śledzimy czy nie
    #[Route('/toggleFollow/{user}' , methods: ['GET'] , name: 'toggleFollow')]
    public function toggleFollow($user) : Response
    {
        return new Response('logic for toggling like/dislike functionality');
    }
}
