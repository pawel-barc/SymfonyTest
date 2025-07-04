<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class MovieController extends AbstractController
{

    private HttpClientInterface $client;
    private string $apiKey;

    public function __construct(HttpClientInterface $client) 
    {
        $this->client = $client;
        $this->apiKey = $_ENV['TMDB_API_KEY'];
    }

    #[Route('/movie', name: 'app_movie')]
    public function index(Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $response = $this->client->request(
            'GET',
            'https://api.themoviedb.org/3/movie/popular',
            [
                'query' => [
                    'api_key' => $this->apiKey,
                    'language' => 'en-US',
                    'page' => $page
                ]
            ]
        );
        $data = $response->toArray();
        return $this->render('movie/index.html.twig', [
            'movies' => $data['results'],
            'page' => $page,
            'total_pages' => $data['total_pages']
        ]);
    }
}
