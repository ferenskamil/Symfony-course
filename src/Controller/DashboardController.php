<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageFormType;
use App\Form\UserFormType;
use App\Form\ChangePasswordType;
use App\Form\DeleteAccountFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/dashboard/profile', name: 'app_profile')]
    public function profile(Request $request): Response
    {

        // Image FORM
        $image = new Image();
        $imageForm = $this->createForm(ImageFormType::class , $image);
        $imageForm->handleRequest($request);
        if ($imageForm->isSubmitted() && $imageForm->isValid())
        {
            $image = $imageForm->getData();
            $this->addFlash('status-image' , 'image-updated');
            return $this->redirectToRoute('app_profile');
        }

        // User FORM
        $user = $this->getUser();
        $userForm = $this->createForm(UserFormType::class , $user);
        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid())
        {
            $user = $userForm->getData();
            $this->addFlash('status-form' , 'form-updated');
            return $this->redirectToRoute('app_profile');
        }

        // change password
        $passwordForm = $this->createForm(ChangePasswordType::class , $user);
        $passwordForm->handleRequest($request);
        if ($passwordForm->isSubmitted() && $passwordForm->isValid())
        {
            $user = $passwordForm->getData();
            $this->addFlash('status-form' , 'form-updated');
            return $this->redirectToRoute('app_profile');
        }

        // delete account
        $deleteAccountForm = $this->createForm(DeleteAccountFormType::class , $user);
        $deleteAccountForm->handleRequest($request);
        if ($deleteAccountForm->isSubmitted() && $deleteAccountForm->isValid())
        {
            $user = $deleteAccountForm->getData();
            $this->addFlash('status-form' , 'form-updated');
            return $this->redirectToRoute('app_profile');
        }


        return $this->render('dashboard/edit.html.twig', [
            'imageForm' => $imageForm,
            'userForm' => $userForm,
            'passwordForm' => $passwordForm,
            'deleteAccountForm' => $deleteAccountForm
        ]);
    }
}