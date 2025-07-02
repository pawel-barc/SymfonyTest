<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

final class HelloController extends AbstractController
{
    #[Route('/hello', name: 'app_hello')]
    public function index(): Response
    {
        return $this->render('hello/index.html.twig', [
            'controller_name' => 'HelloController',
        ]);
    }
    // #[Route('/greet', name: 'app_greet')]
    // public function greet(): Response
    // {
    //     return $this->render('greet.html.twig', [
    //     'name' => 'Pawel',
    //     'controller_name' => 'HelloController',
    //     ]);
    // }

    // #[Route('/greet/{name}', name: 'app_greet_dynamic')]
    // public function greetDynamic(string $name): Response
    // {
    //     return $this->render('greet_dynamic.html.twig', [
    //         'name' => ucfirst($name),
    //         'controller_name' => 'HelloController',
    //     ]);
    // }
    // #[Route('/greet/{name}', name: 'greet_optional', defaults: ['name' => 'Guest'])]
    // public function greetOptional(string $name = 'Guest'): Response
    // {
    //     return new Response("Hello, " . ucfirst($name));
    // }

    // #[Route('/greet/{name}/{age}', name: 'api_user_info')]
    // public function userInfo(string $name, int $age): JsonResponse 
    // {
    //     if ($age < 18) {
    //         $note = 'you are a minor';
    //     } else {
    //         $note = 'you are a major';
    //     }

        
    //     return new JsonResponse([
    //         'message' => 'Hello ' . ucfirst($name) . ', ' . 'you are ' . $age . ' years old, ' . $note
    //     ]);
    // }

#[Route('/greet{name}', name: 'app_greet')]
public function greet(string $name): Response
{
    return $this->render('/greet.html.twig', ['name' => $name]);
}

    #[Route('/greet/{name}/{age}', name: 'api_user_info')]
    public function userInfo(string $name, int $age): JsonResponse
     {
        $message = sprintf('Hello %s, You are %d years old - %s.', ucfirst($name), $age, $age <= 18 ? 'You are a minor' : 'You are a major');
        return new JsonResponse(['message' => $message]);
    }
}
