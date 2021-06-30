<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManager;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/collegues")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {

        //dd($this->getUser()->getFriends());
        return $this->render('coworkers/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }
    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('coworkers/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $friend): Response
    {
        if ($this->isCsrfTokenValid('delete' . $friend->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($friend);
            $this->getUser()->removeFriend($friend);
            $entityManager->flush();
        }
        return $this->redirectToRoute('user_index');
    }

    /**
     * @Route("add-friend/{id}", name="friend_add", methods={"GET"})
     */
    public function addFriend(Request $request, User $friend): Response
    {


            $entityManager = $this->getDoctrine()->getManager();

            $this->getUser()->addFriend($friend);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
    }
}
