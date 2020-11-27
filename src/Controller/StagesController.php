<?php

namespace App\Controller;

use App\Entity\Matchs;
use App\Entity\Stage;
use App\Form\CreateStageFormType;
use App\Form\EditProfileFormType;
use App\Repository\MatchsRepository;
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
      public function create(Request $request, EntityManagerInterface $em, MatchsRepository $matchsrepo)
      {       
        // $matchs = $repomatchlist->findAll([]);
        // dd($request);        

        if($request->isMethod('POST'))
        { 

            $data = $request->request->all();  
            // dd($data['MatchId']);

            // dd($data['MatchId']);
             // $data['MatchId'] = getMatchId(Entity::class,[
             //    'class' => Matchs::class]);
          
            if ($this->isCsrfTokenValid('stage_create', $data['_token']))
            {     

                 // dd($_SERVER['DOCUMENT_ROOT']);

                $file = $request->files->get('file');


                 $stages = new Stage;       


        //  traitement image recu

                $file = $data["jpeg"];
                $file = explode(";", $file)[1];
                $file = explode(",", $file)[1];
                $file = str_replace(" ", "+", $file);
                $file = base64_decode($file);  
                // dd($file); 
                // $file  = $_FILES['file']['tmp_name'];
                            

        // traitement infos recu
                $stagename = $data['stagename'];
                $stagename = preg_replace("# #", "_", $stagename);                    
                $stagename = preg_replace( "# #", "_", $data['stagename']); 
                $stagenumber = $data['stagenumber'];       

                
         // chemin move pdf et image                
                $path_pdf = "uploads/pdf/";
                $path_img = "uploads/img/";

        // nommage des fichiers image et pdf
                $filename = $stagename ." _ ". $stagenumber ." _ ". "1" ." _ ". md5(uniqid()) . "." . "pdf";
                $filenameimg = $stagename ." _ ". $stagenumber ." _ ". "1" ." _ ". md5(uniqid()) . "." . "jpeg";

        // nommage des chemins de fichier image et pdf                
                $fileurl = $path_pdf . $filename;                
                $fileurlimg = $path_img . $filenameimg;

                // file_put_contents($fileurl, $file);
                file_put_contents($fileurlimg, $file);

                move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $fileurl);

                // $file->move($path_pdf,$filename);  
                // $file->move($path_img,$filenameimg);         
       
                // $image->move($this->getParameter('upload_directory'), $filename);
                 // dd($data);

                $stages->setUser($this->getUser());

                // match id                        
                 // $stages->setMatchsId($data['MatchsId']); 
                 //$stages->setMatchsId($data['MatchsId'],$matchsrepo);
                // $stages->setMatchsId($this->getMatchsId($data['matchs_id']));
                // $stages->setMatchsId($this->getMatchsId());               
           


                $stages->setstagenumber($stagenumber);
                $stages->setstagename($stagename);

                $stages->setFilename($filename);
                $stages->setFileurl($fileurl);
                $stages->setFilenameimg($filenameimg);
                $stages->setFileurlimg($fileurlimg);

                $stages->setStartOn($data['StartOn']);
                $stages->setCourseId($data['CourseId']);
                $stages->setReportOn($data['ReportOn']);
                $stages->setStringCnt($data['StringCnt']);
                $stages->setFirearmId($data['FirearmId']);
                $stages->setTrgtTypeId($data['TrgtTypeId']);
                $stages->setScoringId($data['ScoringId']);

                // $stages->setCreatedAt(new \DateTime()); 
                // $stages->setUpdatedAt(new \DateTime());               
                
            //  stages->setIcsStageId($data['ics_stage_id']);
                $stages->setTrgtPaper($data['TrgtPaper']);
                $stages->setTrgtPopper($data['TrgtPopper']);
                $stages->setTrgtPlates($data['TrgtPlates']);
                $stages->setTrgtVanish(0);
                $stages->setTrgtPenlty($data['TrgtPenlty']);
                $stages->setMaxPoints($data['MaxPoints']);
                $stages->setMinRounds($data['MinRounds']);
                $stages->setStartPos($data['StartPos']);
                $stages->setDescriptn($data['Descriptn']);
                $stages->setBobber($data['bobber']);
                $stages->setShowall(0);
                $stages->setLocation(0);
                $stages->setDatastage($data['datastage']);

                $em->persist($stages);
                $em->flush();

            }
            $this->addFlash('success', 'Stage successfully created !');
                return $this->redirectToRoute('app_stage_create');
            
        }

        return $this->render('stages/createstage.html.twig', [
            'title' => 'Create stage TSV STAGE MAKER',
            'current_menu' => "create", 
            // 'matchs' => $matchs,           
        ]);
    }
    



    // public function createstage(Request $request, EntityManagerInterface $em): Response
    // {
    // 	$stage = new Stage;
    //     $form = $this->createForm(CreateStageFormType::class, $stage);
    //     $form->handleRequest($request);

    //      if ($form->isSubmitted() && $form->isValid()) {
    //         $stage->setUser($this->getUser());
    //         $stage->setMatchsId($this->getMatchsId());
    //      	$em->persist($user);
    //         $em->flush();

    //         $this->addFlash('success', 'Stage successfully created !');
    //              return $this->redirectToRoute('stage_create');
    //     }
         

    // 	return $this->render('stages/createstage.html.twig', [
    // 		'CreateStageForm' => $form->createView()
    // 	]);

    // }
    
    


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
                 // dd($_SERVER['DOCUMENT_ROOT']);

                $file = $request->files->get('file');


                 $stages = new Stages;       


        //  traitement image recu

                $file = $data["jpeg"];
                $file = explode(";", $file)[1];
                $file = explode(",", $file)[1];
                $file = str_replace(" ", "+", $file);
                $file = base64_decode($file);  
                // dd($file); 
                // $file  = $_FILES['file']['tmp_name'];
                            

        // traitement infos recu
                $stagename = $data['stagename'];
                $stagename = preg_replace("# #", "_", $stagename);                    
                $stagename = preg_replace( "# #", "_", $data['stagename']); 
                $stagenumber = $data['stagenumber'];       

                
         // chemin move pdf et image                
                $path_pdf = "uploads/pdf/";
                $path_img = "uploads/img/";

        // nommage des fichiers image et pdf
                $filename = $stagename ." _ ". $stagenumber ." _ ". "1" ." _ ". md5(uniqid()) . "." . "pdf";
                $filenameimg = $stagename ." _ ". $stagenumber ." _ ". "1" ." _ ". md5(uniqid()) . "." . "jpeg";

        // nommage des chemins de fichier image et pdf                
                $fileurl = $path_pdf . $filename;                
                $fileurlimg = $path_img . $filenameimg;

                // file_put_contents($fileurl, $file);
                file_put_contents($fileurlimg, $file);

                move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $fileurl);

                // $file->move($path_pdf,$filename);  
                // $file->move($path_img,$filenameimg);         
       
                // $image->move($this->getParameter('upload_directory'), $filename);
                 // dd($stages);

                $stages->setUser($this->getUser());

                // match id 
                $matchs = $data['matchs_id'];                
                // $stages->setMatchs($this->getMatchs());

                $stages->setstagenumber($stagenumber);
                $stages->setstagename($stagename);

                $stages->setFilename($filename);
                $stages->setFileurl($fileurl);
                $stages->setFilenameimg($filenameimg);
                $stages->setFileurlimg($fileurlimg);

                $stages->setStartOn($data['StartOn']);
                $stages->setCourseId($data['CourseId']);
                $stages->setReportOn($data['ReportOn']);
                $stages->setStringCnt($data['StringCnt']);
                $stages->setFirearmId($data['FirearmId']);
                $stages->setTrgtTypeId($data['TrgtTypeId']);
                $stages->setScoringId($data['ScoringId']);

                // $stages->setCreatedAt(new \DateTime()); 
                // $stages->setUpdatedAt(new \DateTime());               
                
            //  stages->setIcsStageId($data['ics_stage_id']);
                $stages->setTrgtPaper($data['TrgtPaper']);
                $stages->setTrgtPopper($data['TrgtPopper']);
                $stages->setTrgtPlates($data['TrgtPlates']);
                $stages->setTrgtVanish(0);
                $stages->setTrgtPenlty($data['TrgtPenlty']);
                $stages->setMaxPoints($data['MaxPoints']);
                $stages->setMinRounds($data['MinRounds']);
                $stages->setStartPos($data['StartPos']);
                $stages->setDescriptn($data['Descriptn']);
                $stages->setBobber($data['bobber']);
                $stages->setShowall(0);
                $stages->setLocation(0);
                $stages->setDatastage($data['datastage']);

                $em->persist($stages);

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
