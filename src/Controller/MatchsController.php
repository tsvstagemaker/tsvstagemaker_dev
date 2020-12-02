<?php

namespace App\Controller;

use App\Repository\MatchsRepository;
use App\Entity\Matchs;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
                $matchs->setNbrStage($data['nbrStage']);

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


 }