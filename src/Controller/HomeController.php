<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(UserRepository $repository, Request $request): Response
    {
        $data = new SearchData();
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);
        $user = $repository->findSearch($data);
        return $this->render('home/index.html.twig', ['users' => $user,'form' => $form->createView()]);
    }
}
