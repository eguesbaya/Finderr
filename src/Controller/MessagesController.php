<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Form\MessagesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MessagesController extends AbstractController
{
    /**
     * @Route("/messages", name="messages")
     */
    public function index(): Response
    {
        return $this->render('messages/index.html.twig', [
            'controller_name' => 'MessagesController',
        ]);
    }

    /**
     * @Route("send", name="send")
     */
    public function send(Request $request): Response
    {
        $message = new Messages();
        $form = $this->createForm(MessagesType::class, $message);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setSender($this->getUser());

            $ema = $this->getDoctrine()->getManager();
            $ema->persist($message);
            $ema->flush();

            $this->addFlash("message", "Your message was send with success.");
            return $this->redirectToRoute("messages");
        }

        return $this->render("messages/send.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
    * @Route("/received", name="received")
    */
    public function received(): Response
    {
        return $this->render('messages/received.html.twig');
    }

    /**
    * @Route("/read/{id}", name="read")
    */
    public function read(Messages $message): Response
    {
        $message->setIsRead(true);
        $ema = $this->getDoctrine()->getManager();
        $ema->persist($message);
        $ema->flush();

        return $this->render('messages/read.html.twig', compact("message"));
    }

    /**
    * @Route("/delete/{id}", name="delete")
    */
    public function delete(Messages $message): Response
    {
        $ema = $this->getDoctrine()->getManager();
        $ema->remove($message);
        $ema->flush();

        return $this->redirectToRoute("received");
    }

    /**
    * @Route("/sent", name="sent")
    */
    public function sent(): Response
    {
        return $this->render('messages/sent.html.twig');
    }
}
