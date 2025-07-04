<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileTypeForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function edit(Request $req, EntityManagerInterface $em ): Response
    {   
        /** @var User $user */
        $user = $this->getUser();
        if(!$user) {
            return $this->redirectToRoute('app_login');
        }
        $form = $this->createForm(ProfileTypeForm::class, $user);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Profile updated successfully');
            return $this->redirectToRoute('app_profile');
        }
        return $this->render('profile/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
