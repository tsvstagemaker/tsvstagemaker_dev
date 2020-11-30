<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordFormType;
use App\Form\EditProfileFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(): Response
    {
        return $this->render('profile/index.html.twig');
    }

     /**
     * @Route("/profile/editprofile", name="edit_profile", methods={"GET", "POST"})
     */
    public function editprofile(Request $request, EntityManagerInterface $em): Response
    {        
    	$user = $this->getUser();
        $form = $this->createForm(EditProfileFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {


            // encode the plain password
            // $user->setPassword(
            //     $passwordEncoder->encodePassword(
            //         $user,
            //         $form->get('plainPassword')->getData()
            //     )
            // );

            // $entityManager = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Your account has been successfully updated !');

            // generate a signed url and email it to the user
            // $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
            //     (new TemplatedEmail())
            //         ->from(new Address('noreply@tsvstagemaker.com', 'TSV STAGE MAKER'))
            //         ->to($user->getEmail())
            //         ->subject('Please Confirm your Email')
            //         ->htmlTemplate('emails/registration/confirmation.html.twig')
            // );
            // do anything else you need here, like send an email

            // return $guardHandler->authenticateUserAndHandleSuccess(
            //     $user,
            //     $request,
            //     $authenticator,
            //     'main' // firewall name in security.yaml
            //);
            //
           return $this->redirectToRoute('profile'); 
        }
			
          return $this->render('profile/editprofile.html.twig', [
            'EditProfileForm' => $form->createView(),
        ]);
    }

      /**
     * @Route("/profile/change-password", name="app_profile_change_password", methods={"GET", "POST"})
     */
    public function changePassword(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder): Response
    {        
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $user->setPassword
            (
                $passwordEncoder->encodePassword($user, $form->get('plainPassword')->getData())
            );
  
            $em->flush();
            $this->addFlash('success', 'Your password has been successfully updated !');

                 return $this->redirectToRoute('profile'); 
        }
            
          return $this->render('profile/change_password.html.twig',
            [
            'form' => $form->createView()
            ]);
    }
      
}

