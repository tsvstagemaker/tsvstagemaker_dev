<?php

namespace App\Controller;

use App\Entity\Matchs;
use App\Entity\Stage;
use App\Entity\UploadLogo;
use App\Form\CreateStageFormType;
use App\Form\EditProfileFormType;
use App\Form\UploadLogoType;
use App\Repository\MatchsRepository;
use App\Repository\StageRepository;
use App\Repository\UploadLogoRepository;
use DoctrineMigrations\stages;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
    public function index(Request $request, PaginatorInterface $paginator): Response
    {

    	$datastages = $this->getDoctrine()->getRepository(Stage::class)->findBy([], 
            ['createdAt' => 'desc']);

        $stages = $paginator->paginate(
            $datastages,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('stages/index.html.twig', [
            'stages' => $stages,
        ]);
    }

    
    
    /**   
     * @Route("/stages/create", name="app_stage_create", methods={"GET", "POST"})
     */
    public function create(Request $request, EntityManagerInterface $em, MatchsRepository $matchsrepo)
    {    

        $stages = new Stage;
        // form match
        $form = $this->createFormBuilder($stages)
        ->add('MatchsId', EntityType::class,[
            'class' => Matchs::class,
            'choices' => $stages->getUser(),
    // 'choices' => getMatchsId(),           
        ])             
        ->getForm();    

        // $matchs = $repomatchlist->findAll([]);
         // dd($matchsrepo);        

        if($request->isMethod('POST'))
        { 

            $data = $request->request->all();            

            // dd($data);
             // $data['MatchId'] = getMatchId(Entity::class,[
             //    'class' => Matchs::class]);

            if ($this->isCsrfTokenValid('stage_create', $data['_token']))
            {     

                 // dd($_SERVER['DOCUMENT_ROOT']);

                $file = $request->files->get('file');


                 // $stages = new Stage;   




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
                // $stagename = preg_replace( "# #", "_", $data['stagename']); 
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


                // Debut enregistrement db

                $stages->setUser($this->getUser());
                // dd($this->getUser()->getMatchs());

                $MatchsId = $data['MatchsId'];
                // $MatchsId->getMatchsId();
                // dd($MatchsId);
                // getMatchsId()->$MatchsId;
                // dd($MatchsId);
                // $stages->setMatchsId($this->getMatchsId($MatchsId));
                // dd($this);

               // dd($data);

                // match id 
                // $MatchsId = $data['MatchsId'];
                // $MatchsName = $data['name'];
                //  dd($MatchsName);                    
                // $stages->setMatchsId($MatchsId); 
                // $stages->setMatchsId($data['MatchsId'],$matchsrepo);                
                // $stages->setMatchsId($this->$MatchsId);
                // $stages->setMatchsId($this->getMatchsId());
              // $stages->setMatchsId($this->getMatchsId(EntityType::class, $MatchsId));                



                $stages->setstagenumber($stagenumber);
                $stages->setstagename($data['stagename']);

                $stages->setFilename($filename);
                $stages->setFileurl($fileurl);
                $stages->setFilenameimg($filenameimg);
                $stages->setFileurlimg($fileurlimg);

                $stages->setStartOn($data['StartOn']);
                $stages->setCourseId($data['CourseId']);
                $stages->setReportOn('True');
                $stages->setStringCnt(0);
                $stages->setFirearmId($data['FirearmId']);
                $stages->setTrgtTypeId($data['TrgtTypeId']);
                $stages->setScoringId($data['ScoringId']);
                $stages->setWithdraw($data['Withdraw']);

                // $stages->setCreatedAt(new \DateTime()); 
                // $stages->setUpdatedAt(new \DateTime());               
                
                // stages->setIcsStageId($data['ics_stage_id']);
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
            'formMatch' => $form->createView() 
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

                $file = $request->files->get('file');

                $stages = new Stage; 

        //  traitement image recu

                $file = $data["jpeg"];
                $file = explode(";", $file)[1];
                $file = explode(",", $file)[1];
                $file = str_replace(" ", "+", $file);
                $file = base64_decode($file);                            

        // traitement infos recu
                $stagename = $data['stagename'];
                $stagename = preg_replace("# #", "_", $stagename);                    
                // $stagename = preg_replace( "# #", "_", $data['stagename']); 
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

                 // Debut enregistrement db

                $stages->setUser($this->getUser());

                // match id                        
                 // $stages->setMatchsId($data['MatchsId']); 
                // $stages->setMatchsId($data['MatchsId'],$matchsrepo);
                // $MatchsId = $data['MatchsId'];
                // $stages->setMatchsId($this->$MatchsId);
                // $stages->setMatchsId($this->getMatchsId());

                $stages->setstagenumber($stagenumber);
                $stages->setstagename($data['stagename']);

                $stages->setFilename($filename);
                $stages->setFileurl($fileurl);
                $stages->setFilenameimg($filenameimg);
                $stages->setFileurlimg($fileurlimg);

                $stages->setStartOn($data['StartOn']);
                $stages->setCourseId($data['CourseId']);
                // $stages->setReportOn($data['ReportOn']);
                // $stages->setStringCnt($data['StringCnt']);
                $stages->setFirearmId($data['FirearmId']);
                $stages->setTrgtTypeId($data['TrgtTypeId']);
                $stages->setScoringId($data['ScoringId']);  
                $stages->setWithdraw($data['Withdraw']);            

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
            return $this->redirectToRoute('app_stages');

        }

        return $this->render('stages/editstage.html.twig', compact('stage'));
    }


       /**
     * @Route("/stages/{id<[0-9]+>}/delete", name="app_stage_delete", methods={"DELETE"})
     */
       public function deleteStage(Request $request, Stage $stage, EntityManagerInterface $em): Response
       {

        if ($this->isCsrfTokenValid('stage_deletion_' . $stage->getId(), $request->request->get('csrf_token')))
        {
            $em->remove($stage);
            $em->flush();

            $this->addFlash('success', 'Stage successfully deleted !');
            return $this->redirectToRoute('app_stages');
        }

        elseif ($this->isCsrfTokenValid('stage_deletion_profil_' . $stage->getId(), $request->request->get('csrf_token')))
        {
            $em->remove($stage);
            $em->flush();

            $this->addFlash('success', 'Stage successfully deleted !');
            return $this->redirectToRoute('app_profile');

        }

        elseif ($this->isCsrfTokenValid('stage_deletion_show_' . $stage->getId(), $request->request->get('csrf_token')))
        {
            // $match_id = $request->request->all();
            // $matchs = $match_id['match_id'];
            // $match_id['match_id'];

            $em->remove($stage);
            $em->flush();

            $this->addFlash('success', 'Stage successfully deleted !');
            return $this->redirectToRoute('app_stages');
            // return $this->redirectToRoute('app_match_show',);
            // return $this->redirectToRoute('app_match_show', ['id' => $matchs]);
            // return $this->redirectToRoute('app_match_show', ['id' => $match->getId()]);

        }
        
    }


         /**
     * @Route("/stages/{id<[0-9]+>}/share", name="app_stage_share", methods={"POST"})
     */
         public function shareStage(Request $request, Stage $stage, EntityManagerInterface $em): Response
         {

            if ($this->isCsrfTokenValid('stage_share_' . $stage->getId(), $request->request->get('csrf_token')))
            {           
                if ($stage->getShowall() == false ) {
                    $stage->setShowall(true);
                }else{
                   $stage->setShowall(false); 
               }

               $em->flush();

               $this->addFlash('success', 'Stage successfully shared !');
               return $this->redirectToRoute('app_stages');
           }

           elseif ($this->isCsrfTokenValid('stage_share_profile' . $stage->getId(), $request->request->get('csrf_token')))
           {           
            if ($stage->getShowall() == false ) {
                $stage->setShowall(true);
            }else{
               $stage->setShowall(false); 
           }

           $em->flush();

           $this->addFlash('success', 'Stage successfully shared !');
           return $this->redirectToRoute('app_profile');
       }

   }


      /**
     * @Route("/stages/create/", name="app_upload_logo", methods={"POST"})
     */
      public function UploadLogo(Request $request, EntityManagerInterface $em): Response
      {

         // dd($request);

         if($request->isMethod('POST'))
         { 
            $data = $request->request->all(); 
             // dd($data);

           if ($this->isCsrfTokenValid('stage_create_logo', $data['_token_logo']))
           {  

            //  $form->handleRequest($request);
            // if ($form->isSubmitted() && $form->isValid()) {
            
            $file = $request->files->get('file');
            // dd($file);
            
            $upload_logo = new UploadLogo();

                // file name
                $filename = $_FILES['file']['name'];
                    // dd($filename);
                // Location
                $location = 'uploads/logos_objects/'.$filename;

                $filepath = 'uploads/logos_objects/'.$filename;

                // file extension
                $file_extension = pathinfo($location, PATHINFO_EXTENSION);
                $file_extension = strtolower($file_extension);

                // Valid image extensions
                $image_ext = array("jpg","png","jpeg","gif","webp","svg");

                if (!in_array($file_extension, $image_ext)) {
                  $this->addFlash('error', 'Only format file: "jpg","png","jpeg","gif","webp","svg" accepted !');
                  return $this->redirectToRoute('app_stage_create');
                }

                  $response = 0;
                  if(in_array($file_extension,$image_ext)){
                    // Upload file
                    if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                      $response = $location;
                    }
                  }
                   // $response = $filepath;

                $upload_logo->setUser($this->getUser());
                $upload_logo->setName($filename);
                $upload_logo->setlogopath($filepath);

                $em->persist($upload_logo);
                $em->flush();

                // dd($response);
              
                
            $this->addFlash('success', 'Logo or object successfully uploaded !');
            return $this->redirectToRoute('app_stage_create', array(
              'response' => $response
            ));            

         }

        }

    }


        /**
     * @Route("/profile/{id<[0-9]+>}/delete", name="app_logo_delete", methods={"DELETE"})
     */
       public function deletelogo(Request $request, UploadLogo $uploadlogo, EntityManagerInterface $em): Response
       {

        if ($this->isCsrfTokenValid('logo_deletion_profil_' . $uploadlogo->getId(), $request->request->get('csrf_token')))
        {
            $em->remove($uploadlogo);
            $em->flush();

            $this->addFlash('success', 'Logo or object successfully deleted !');
            return $this->redirectToRoute('app_profile');
        }   

        elseif ($this->isCsrfTokenValid('logo_deletion_stage_' . $uploadlogo->getId(), $request->request->get('csrf_token')))
        {
            $em->remove($uploadlogo);
            $em->flush();

            $this->addFlash('success', 'Logo or object successfully deleted !');
            return $this->redirectToRoute('app_stage_create');
        }   
        
    }




}