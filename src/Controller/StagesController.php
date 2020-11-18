<?php

namespace App\Controller;

use App\Entity\Stage;
use App\Form\EditProfileFormType;
use App\Repository\StageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class StagesController extends AbstractController
{
    /**
     * @Route("/stages", name="app_stages")
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

    	$stages = new Stage;
    	$form = $this->createFormBuilder()
    		->add('stagename', TextType::class)
    		->add('numstage', ChoiceType::class,[
    											'choices' =>[
    														'1' => '1',
	                                                        '2' => '2',
	                                                        '3' => '3',
	                                                        '4' => '4',
	                                                        '5' => '5',
	                                                        '6' => '6',
	                                                        '7' => '7',
	                                                        '8' => '8',
	                                                        '9' => '9',
	                                                        '10' => '10',
	                                                        '11' => '11', 
	                                                        '12' => '12',
	                                                        '13' => '13',
	                                                        '14' => '14',
	                                                        '15' => '15',
	                                                        '16' => '16',
	                                                        '17' => '17',
	                                                        '18' => '18',
	                                                        '19' => '19',
	                                                        '20' => '20',
	                                                        '21' => '21', 
	                                                        '22' => '22',
	                                                        '23' => '23',
	                                                        '24' => '24',
	                                                        '25' => '25',
	                                                        '26' => '26',
	                                                        '27' => '27',
	                                                        '28' => '28',
	                                                        '29' => '29',
	                                                        '30' => '30',
	                                                        '31' => '31',
	                                                        '31' => '32',
                                                        	]])

            ->add('MinRounds',IntegerType::class)
            ->add('MaxPoints',IntegerType::class)             

            ->add('TrgtPaper',IntegerType::class)
            ->add('TrgtPopper',IntegerType::class) 
            ->add('TrgtPlates',IntegerType::class)
            ->add('bobber',IntegerType::class)
            ->add('TrgtVanish',IntegerType::class) 
            ->add('TrgtPenlty',IntegerType::class)     

            ->add('filename', TextType::class)
            ->add('fileurl', TextType::class)
            ->add('filenameimg', TextType::class)
            ->add('fileurlimg', TextType::class)
            
            ->add('Descriptn', TextType::class)
            ->add('StartPos', TextType::class)

              ->add('CourseId', ChoiceType::class,[
    										'choices' =>[
    													'SHORT COURSE' => '1', 
                                                        'EDIUM COURSE' => '2',
                                                        'LONG COURSE' => '3',                                                        
                                                  		 ]])

              ->add('StartOn', ChoiceType::class,[
              									'choices' =>[
              									'1' => '00', 
                                                '2' => '10',
                                                '3' => '20',                                                        
                                                        ]])

              ->add('ScoringId', ChoiceType::class,[
              									'choices' =>[
              											'Comstock' => '1', 
                                                        'Fixed Time' => '2',
                                                        'Virginia Count' => '3',                                                        
                                                        ]])


            ->add('matchlevel', ChoiceType::class,[
              									'choices' =>[
              											 'TRAINING'=> '0',
                                                         'LEVEL I' => '1', 
                                                         'LEVEL II' => '2',
                                                         'LEVEL III' => '3',
                                                         'LEVEL VI' => '4',
                                                         'LEVEL V' => '5',
                                                       ]])

            ->add('ReportOn', ChoiceType::class,[
              									'choices' =>[
              											'Without' => '0', 
                                                        'With' => '1',                                                                                                        
                                                       ]])

            ->add('StringCnt', ChoiceType::class,[
              									'choices' =>[
              											'Without' => '0', 
                                                        'With' => '1',                                                                                                        
                                                        ]])

            ->add('TrgtTypeId', ChoiceType::class,[
              									'choices' =>[
              											'Classic' => '2', 
                                                        'Metric' => '1',                                                                                                        
                                                        ]])


            ->add('MatchDirector', TextType::class)
            ->add('RangeMaster', TextType::class)
            ->add('StatsDirector', TextType::class)

            ->add('FirearmId', ChoiceType::class,[
              									'choices' =>[
              									 		  'Handgun' => '1', 
                                                          'Rifle' => '2',
                                                          'Shotgun' => '3',
                                                          'Action Air' => '5',
                                                          'Mini-Rifle' => '6',
                                                          'PCC' => '7',
                                                      ]])         

            ->add('matchid', ChoiceType::class,[
              									'choices' =>[
              											'1' => '1', 
                                                        '2' => '2',
                                                        '3' => '3',
                                                        '4' => '4',
                                                        '5' => '5',
                                                        '6' => '6',
                                                        '7' => '7',
                                                        '8' => '8',
                                                        '9' => '9',
                                                        '10' => '10',
                                                        ]])           

            ->add('datastage', TextType::class)
            ->add('IcsStageId', IntegerType::class)

            ->getForm()

    	;

    	// $form->handleRequest($request);

    	// if ($form->isSubmitted() && $form->isValid()) 
     //    {

     //    	}
        	


    	return $this->render('stages/createstage.html.twig', [
    		'form' => $form->createView()
    	]);

    }

    /**
     * @Route("/stages/{id<[0-9]+>}", name="app_stages_show")
     */
    public function showstage(Stage $stage): Response
    {
		return $this->render('stages/showstage.html.twig', compact('stage'));
        
    }
}
