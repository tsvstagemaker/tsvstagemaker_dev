<?php

namespace App\Controller;

use App\Entity\Matchs;
use App\Entity\Stage;
use App\Form\CreateStageFormType;
use App\Form\EditProfileFormType;
use App\Repository\StageRepository;
use DoctrineMigrations\stages;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class StagesController extends AbstractController
{
    
    /**
     * [index description]
     * @param  StageRepository $StageRepository [description]
     * @return [type]                           [description]
     * @Route("/stages", name="app_stages", methods={"GET"})
     */
    public function index(StageRepository $StageRepository): Response
    {

    	$stages = $StageRepository->findBy([], ['createdAt' => 'DESC']);

        return $this->render('stages/index.html.twig', compact('stages'));
    }

    
    
    /**   
     * @Route("/stages/create", name="app_stage_create", methods={"GET", "POST"})
     */
    public function createstage(Request $request, EntityManagerInterface $em): Response
    {
    	$stage = new Stage;
        $form = $this->createForm(CreateStageFormType::class, $stage);
        $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {

         	$em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Stage successfully created !');
                 return $this->redirectToRoute('stage_create');
        }
         

    	return $this->render('stages/createstage.html.twig', [
    		'CreateStageForm' => $form->createView()
    	]);

    }

    /**
     * @Route("/stages/{id<[0-9]+>}/show", name="app_stages_show", methods={"GET"})
     */
    public function showstage(Stage $stage): Response
    {
		return $this->render('stages/showstage.html.twig', compact('stage'));
        
    }


     /**
     * @Route("/stages/{id<[0-9]+>}/edit", name="app_stage_edit", methods={"GET", "PUT", "POST"})
     */
     public function editstage(Stage $stage, Request $request, EntityManagerInterface $em): Response
     {  

     if($request->isMethod('POST'))
        {
            $data = $request->request->all();     
            
            if ($this->isCsrfTokenValid('stage_edit', $data['_token']))
            {  

                $em->flush();

            }
            $this->addFlash('success', 'Stage successfully edited !');
                return $this->redirectToRoute('stages');
            
        }

        return $this->render('stages/editstage.html.twig', compact('stage'));
    }


       /**
     * @Route("/stages/{id<[0-9]+>}/delete", name="app_stage_delete", methods={"DELETE"})
     */
     public function deleteStage(Request $request, stages $stage, EntityManagerInterface $em): Response
     {
        if ($this->isCsrfTokenValid('stage_deletion_' . $stage->getId(), $request->request->get('csrf_token')))
        {
            $em->remove($stage);
            $em->flush();
        }
        $this->addFlash('primary', 'Stage successfully deleted !');
            return $this->redirectToRoute('stages');
      }
}
