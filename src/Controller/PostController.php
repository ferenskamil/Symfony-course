<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Importujemy to co niezbędne do stworzenia formularza
use App\Entity\Post;
use App\Form\NewPostType;

// Do walidacji
use Symfony\Component\HttpFoundation\Request;

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
    public function new(Request $request) : Response
    {
        // Tworzymy instancję entity
        $post = new Post();
        // $post->setTitle('New post');
        // $post->setContent('Lorem ipsum dolor es');

        // tworzymy formularz
        $form = $this->createForm(NewPostType::class , $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() )
        {
            $form->getData();
            return $this->redirectToRoute('posts.index');
        }

        // Zabezpieczenie przed dostępem dla niezalogowanych
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('post/new.html.twig' , [
            'myNewPostForm' => $form
        ]);
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

    #[Route('post/{id}/edit' , methods: ['GET' , 'POST']  , name: 'posts.edit')]
    public function edit(Request $request) : Response
    {

        // Zabezpieczenie przed dostępem dla niezalogowanych
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $post = new Post(); // W przyszłości będziemy musieli znaleźć nowy post po ID
        $form = $this->createForm(NewPostType::class , $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() )
        {
            $post = $form->getData();
            return $this->redirectToRoute('posts.index');
        }

        // return $this->redirectToRoute('posts.index');
        return $this->render('post/edit.html.twig' , [
            'myEditPostForm' => $form
        ]);
    }

    #[Route('/post/{id}/delete' , methods: ['POST'] , name: 'posts.delete')]
    public function delete($id) : Response
    {
        // Zabezpieczenie przed dostępem dla niezalogowanych
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return new Response('delete post from the database');
    }

    // Za pomoca tego route'a będziemy przełączali czy użytkownika śledzimy czy nie
    #[Route('/toggleFollow/{user}' , methods: ['GET'] , name: 'toggleFollow')]
    public function toggleFollow($user) : Response
    {
        // Zabezpieczenie przed dostępem dla niezalogowanych
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return new Response('logic for toggling like/dislike functionality');
    }
}
