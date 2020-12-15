<?php

namespace App\Controller;

use App\Repository\MatchsRepository;
use App\Entity\Matchs;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use ZipArchive;

class MatchsController extends AbstractController
{
    /**
     * @Route("/matchs", name="app_matchs", methods={"GET"})
     */
    public function index(MatchsRepository $repo): Response
    {
    	$matchs = $repo->findBy([], ['createdAt' => 'DESC']); 
    	return $this->render('matchs/index.html.twig', [
    		'current_menu' => "app_matchs",
    		'matchs' => $matchs,
    	]);
    }  


     /**
     * @Route("/matchs/create", name="app_match_create", methods={"GET", "POST"})
     */
     public function creatematch(Request $request, EntityManagerInterface $em)
     {      


     	if($request->isMethod('POST')){
     		$data = $request->request->all();
              // dd($data);   

     		if ($this->isCsrfTokenValid('match_create', $data['_token'])){            

     			$matchs = new Matchs;
                $matchs->setUser($this->getUser());
                 // dd($matchs);
                $matchs->setName($data['name']);     	
                $matchs->setFirearmtype($data['firearmtype']);
                $matchs->setMatchlevel($data['matchlevel']);
                $matchs->setStartAt($data['startAt']);
                $matchs->setMatchdirector($data['MatchDirector']);
                $matchs->setRangemaster($data['RangeMaster']);
                $matchs->setStatsdirector($data['StatsDirector']);
                $matchs->setClubname($data['clubName']);
                $matchs->setCountryid($data['CountryId']);
                $matchs->setSquadcount($data['SquadCount']);
                $matchs->setMatchid($data['matchid']);
                $matchs->setNbrStage($data['nbrStage']);

                $em->persist($matchs);
                $em->flush();

                $this->addFlash('success', 'Match successfully created !');
                return $this->redirectToRoute('app_matchs');

            }            


        }

        return $this->render('matchs/creatematch.html.twig', [
         'title' => 'Create stage TSV STAGE MAKER',
         'current_menu' => "create",            
     ]);

    }


    /**
     * @Route("/matchs/{id<[0-9]+>}/show", name="app_match_show", methods={"GET"})
     */
    public function showmatch(Matchs $match): Response
    {
        return $this->render('matchs/showmatch.html.twig', compact('match'));
    }




      /**
     * @Route("/matchs/{id<[0-9]+>}/edit", name="app_match_edit", methods={"GET", "PUT"})
     */
      public function editmatch(Request $request, Matchs $match, EntityManagerInterface $em): Response
      {
        if($request->isMethod('PUT'))
        {

            $data = $request->request->all();    
            
            if ($this->isCsrfTokenValid('match_edit_' . $match->getId(), $request->request->get('csrf_token')))                
            {
                $match->setUser($this->getUser());
                $match->setName($data['name']);
                $match->setFirearmtype($data['firearmtype']);
                $match->setMatchlevel($data['matchlevel']);
                $match->setStartAt($data['startAt']);
                $match->setMatchdirector($data['MatchDirector']);
                $match->setRangemaster($data['RangeMaster']);
                $match->setStatsdirector($data['StatsDirector']);
                $match->setClubname($data['clubName']);
                $match->setCountryid($data['CountryId']);
                $match->setSquadcount($data['SquadCount']);
                $match->setMatchid($data['matchid']);
                $match->setNbrStage($data['nbrStage']);

                $em->flush();               
            }
            $this->addFlash('success', 'Match successfully edited !');
            return $this->redirectToRoute('app_match_show', ['id' => $match->getId()]);
        }
        return $this->render('matchs/editmatch.html.twig', compact('match'));
    }



    /**
     * @Route("/matchs/{id<[0-9]+>}/delete", name="app_match_delete", methods={"DELETE"})
     */
    public function deleteMatch(Request $request, Matchs $match, EntityManagerInterface $em): Response
    {     
        if ($this->isCsrfTokenValid('match_deletion_' . $match->getId(), $request->request->get('csrf_token')))
        {
            $em->remove($match);
            $em->flush();
        }
        $this->addFlash('primary', 'Match successfully deleted !');
        return $this->redirectToRoute('app_matchs');
    }



      /**
     * @Route("/matchs/{id<[0-9]+>}/download", name="app_stages_download", methods={"POST"})
     */
      public function downloadStages(Request $request, Matchs $match, EntityManagerInterface $em): Response
      { 
        if($request->isMethod('POST'))
        {

            if ($this->isCsrfTokenValid('stages_download_' . $match->getId(), $request->request->get('csrf_token')))
            {                              
                // dd($match->getStages());

                $result = $match->getStages();               
                // test1
                // $resultStage = array();
                // foreach ($result as $results) 
                // {
                //     $resultStage[] = array($results->getFilename());
                // }
               
               // test2
                $index_counts = 0;
                $resultStage = array();
                foreach($result as $results) {
                    $resultStage[':stage_'.$index_counts] = $results->getFilename();
                    $index_counts++;
                }

                // test3
                // $resultStage = array();
                // foreach ($result as $results) 
                // {
                //     $resultStage[] = array($results->getFilename());
                // }

                // dd($resultStage);

                

                $path_pdf = "uploads/pdf/";
                $filename = $match->getname()."_"."All_Stages"; 
                $filesname = $resultStage;   

                // dd(class_exists('ZipArchive'));

                $zip = new ZipArchive();// Load zip librairy    
                    if ($zip->open("Allstages.zip", ZIPARCHIVE::CREATE)) 
                    {
                        foreach ($filesname as $file) // membres/"Allstages.zip"
                        {
                            $zip->addFile($path_pdf.$file, "$file"); // Adding filename into zip
                        }
                            $zip->close();
                            //push to download the zip
                            header('Content-Transfer-Encoding: binary');
                            header('Content-Disposition: attachement; filename="Allstages.zip"');
                            header('Content-type: application/zip');                
                            readfile("Allstages.zip");
                                    //Remove zip file is exists in temp path
                            unlink("Allstages.zip");
                            exit();
                    }
                }
            }
            $this->addFlash('primary', 'Stages successfully Downloaded !');
            return $this->redirectToRoute('app_matchs');
        }










    }