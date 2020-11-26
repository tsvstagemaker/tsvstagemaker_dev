<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use App\Notification\MessageNotification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\redirectToRoute;
use Symfony\Component\Form\Extension\HttpFoundation\handleRequest;
use Symfony\Component\Form\createView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     */
    public function NofifyMessage(Request $request, MessageNotification $notification): Response
    {
    	$contact = new Contact();
    	$form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        	$notification->sendEmail($contact);
        	$this->addFlash('success', 'Your message has been send successfully !');
        	return $this->redirectToRoute('app_contact'); 
        
         
        }
        return $this->render('contact/index.html.twig', [
            'current_menu' => "app_contact",
            'ContactForm' => $form->createView(),
        ]);
    }
}
