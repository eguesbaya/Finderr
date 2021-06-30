<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @return Response
     */
    public function index(): Response
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findBy(['id' => rand(11, 20)]);

        return $this->render('home/index.html.twig', ['users' => $user]);
    }
}
