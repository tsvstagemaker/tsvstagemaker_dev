<?php

namespace App\Controller;

use App\Entity\Matchs;
use App\Repository\MatchsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ZipArchive;

  /**     
   * @Security("is_granted('ROLE_USER') and user.isVerified()")
   */
class MatchsController extends AbstractController
{
    /**
     * @Route("/matchs", name="app_matchs", methods={"GET"})
     */
    public function index(MatchsRepository $repo): Response
    {
    	$matchs = $repo->findBy([], ['createdAt' => 'DESC']); 
    	return $this->render('matchs/index.html.twig', [
    		'current_menu' => "app_matchs", //Variable highlight menu
    		'matchs' => $matchs, //Variable list des matchs
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

     			      $matchs = new Matchs; //Créer un match

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
         'title' => 'Create stage TSV STAGE MAKER', //Variable titre
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
                //Edite le match selectionné
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
            $em->remove($match); //Supprime le match selectionné
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
        if($request->isMethod('POST')) //vérifie si c'est une méthode post
        {
            if ($this->isCsrfTokenValid('stages_download_' . $match->getId(), $request->request->get('csrf_token'))) //vérifie si le token est OK
            {
                $result = $match->getStages();   //Récupere l'ID du match dans la variable $match et on get les stages de ce match         

                //On extrait les filenames des stages et on met dans un tableau 
                $index_counts = 0;
                $resultStage = array();
                foreach($result as $results) {
                  $resultStage[':stage_'.$index_counts] = $results->getFilename();
                  $index_counts++;
                }         
                

                $path_pdf = "uploads/pdf/"; //chemin des stages en PDF
                $filename = $match->getname()."_"."All_Stages"; //nom du fichier de sortie du zip
                $filesname = $resultStage; //on mets le tableau des filenames dans une variables

                $zip = new ZipArchive();// Charger la lib zip  
                if ($zip->open("Allstages.zip", ZIPARCHIVE::CREATE)) 
                {
                        foreach ($filesname as $file) // Boucle des filenames dans $file
                        {
                            $zip->addFile($path_pdf.$file, "$file"); // Ajout d'un nom de fichier dans zip
                          }
                          $zip->close();
                            //pousser pour télécharger le zip
                          header('Content-Transfer-Encoding: binary');
                          header('Content-Disposition: attachement; filename="Allstages.zip"');
                          header('Content-type: application/zip');                
                          readfile("Allstages.zip");                                   
                            unlink("Allstages.zip"); //Supprimer le fichier zip existant dans le chemin temporaire
                            exit();
                          }
                        }
                      }
                      $this->addFlash('primary', 'Stages successfully Downloaded !');
                      return $this->redirectToRoute('app_matchs');
                    }






         /**
     * @Route("/matchs/{id<[0-9]+>}/winmss", name="app_winmss_download", methods={"POST"})
     */
         public function winmssDownload(Request $request, Matchs $match, EntityManagerInterface $em): Response
         { 
        if($request->isMethod('POST')) //vérifie si c'est une méthode post
        {
            if ($this->isCsrfTokenValid('winmss_download_' . $match->getId(), $request->request->get('csrf_token'))) //vérifie si le token est OK
            {
                $resultStage = $match->getStages();   //Récupere l'ID du match dans la variable $match et on get les stages de ce match  
                $resultMatch = $match;   //Récupere l'ID du match dans la variable $match et on get les stages de ce match 


                //dd($resultMatch->getname());     

                //On extrait les stages et on met dans un tableau 
                $index_counts = 0;
                $resultWinmssStage = array();
                foreach($resultStage as $results)
                {
                  $resultWinmssStage[':stage_'.$index_counts] = $results;
                  $index_counts++;
                } 

                 // dd($resultWinmss);

                 // XML stage

                $file_out = "uploads/WinMSS/";//chemin de dépot de fichier generer
                // dd($file_out);
                $filesystem = new Filesystem();

                if (!file_exists($file_out)) 
                {
                  $filesystem->mkdir($file_out);
                }
                $dir = $file_out;
                if (!file_exists($dir)) 
                {
                    // mkdir($dir);
                  $filesystem->mkdir($dir, 0777);
                }

                $file_stage = $dir . "/STAGE.XML";

                $xml = "<xml xmlns:s='uuid:BDC6E3F0-6DA3-11d1-A2A3-00AA00C14882'
                xmlns:dt='uuid:C2F41010-65B3-11d1-A29F-00AA00C14882'
                xmlns:rs='urn:schemas-microsoft-com:rowset'
                xmlns:z='#RowsetSchema'>
                <s:Schema id='RowsetSchema'>
                <s:ElementType name='row' content='eltOnly' rs:updatable='true'>
                <s:AttributeType name='MatchId' rs:number='1' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatchStage' rs:basecolumn='MatchId' rs:keycolumn='true'>
                <s:datatype dt:type='int' dt:maxLength='4' rs:precision='10' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='StageId' rs:number='2' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatchStage' rs:basecolumn='StageId' rs:keycolumn='true'>
                <s:datatype dt:type='ui1' dt:maxLength='1' rs:precision='3' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='StageName' rs:number='3' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatchStage' rs:basecolumn='StageName'>
                <s:datatype dt:type='string' dt:maxLength='32'/>
                </s:AttributeType>
                <s:AttributeType name='Location' rs:number='4' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatchStage' rs:basecolumn='Location'>
                <s:datatype dt:type='string' dt:maxLength='32'/>
                </s:AttributeType>
                <s:AttributeType name='FirearmId' rs:number='5' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatchStage' rs:basecolumn='TypeFirearmId'>
                <s:datatype dt:type='ui1' dt:maxLength='1' rs:precision='3' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='CourseId' rs:number='6' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatchStage' rs:basecolumn='TypeStageCourseId'>
                <s:datatype dt:type='ui1' dt:maxLength='1' rs:precision='3' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='ScoringId' rs:number='7' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatchStage' rs:basecolumn='TypeScoringId'>
                <s:datatype dt:type='ui1' dt:maxLength='1' rs:precision='3' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='TrgtTypeId' rs:number='8' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatchStage' rs:basecolumn='TypeTargetClassifyId'>
                <s:datatype dt:type='ui1' dt:maxLength='1' rs:precision='3' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='IcsStageId' rs:number='9' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatchStage' rs:basecolumn='TypeStdStageSetupId'>
                <s:datatype dt:type='i2' dt:maxLength='2' rs:precision='5' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='Remove' rs:number='10' rs:maydefer='true' rs:writeunknown='true' rs:basetable='tblMatchStage'
                rs:basecolumn='RemoveScoring'>
                <s:datatype dt:type='boolean' dt:maxLength='2' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='TrgtPaper' rs:number='11' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatchStage' rs:basecolumn='TrgtPaper'>
                <s:datatype dt:type='ui1' dt:maxLength='1' rs:precision='3' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='TrgtPopper' rs:number='12' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatchStage' rs:basecolumn='TrgtPopper'>
                <s:datatype dt:type='ui1' dt:maxLength='1' rs:precision='3' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='TrgtPlates' rs:number='13' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatchStage' rs:basecolumn='TrgtPlates'>
                <s:datatype dt:type='ui1' dt:maxLength='1' rs:precision='3' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='TrgtVanish' rs:number='14' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatchStage' rs:basecolumn='TrgtDisappear'>
                <s:datatype dt:type='ui1' dt:maxLength='1' rs:precision='3' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='TrgtPenlty' rs:number='15' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatchStage' rs:basecolumn='TrgtPenalty'>
                <s:datatype dt:type='ui1' dt:maxLength='1' rs:precision='3' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='MinRounds' rs:number='16' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatchStage' rs:basecolumn='MinRounds'>
                <s:datatype dt:type='ui1' dt:maxLength='1' rs:precision='3' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='ReportOn' rs:number='17' rs:maydefer='true' rs:writeunknown='true' rs:basetable='tblMatchStage'
                rs:basecolumn='ReportOn'>
                <s:datatype dt:type='boolean' dt:maxLength='2' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='MaxPoints' rs:number='18' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatchStage' rs:basecolumn='MaxPoints'>
                <s:datatype dt:type='i2' dt:maxLength='2' rs:precision='5' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='StartPos' rs:number='19' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatchStage' rs:basecolumn='StartPosition'>
                <s:datatype dt:type='string' dt:maxLength='536870910' rs:long='true'/>
                </s:AttributeType>
                <s:AttributeType name='StartOn' rs:number='20' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatchStage' rs:basecolumn='StartOn'>
                <s:datatype dt:type='string' dt:maxLength='8'/>
                </s:AttributeType>
                <s:AttributeType name='StringCnt' rs:number='21' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatchStage' rs:basecolumn='StringsOfFire'>
                <s:datatype dt:type='ui1' dt:maxLength='1' rs:precision='3' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='Descriptn' rs:number='22' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatchStage' rs:basecolumn='Description'>
                <s:datatype dt:type='string' dt:maxLength='536870910' rs:long='true'/>
                </s:AttributeType>
                <s:extends type='rs:rowbase'/>
                </s:ElementType>
                </s:Schema>
                <rs:data>";

                  // dd($resultWinmss);

                  // foreach( $resultWinmss->fetch() as $id ) {
                foreach ($resultWinmssStage as $id) {
                      // dd($id->getstagename()->$stagename);
                      // dd($resultWinmss);



                  $stagename = $id->getstagename();
                  // dd($stagename);
                  $stagenumber = $id->getstagenumber();
                  $FirearmId = $id->getFirearmId();
                  $TrgtTypeId = $id->getTrgtTypeId();
                  $ScoringId = $id->getScoringId();
                  $StartOn = $id->getStartOn();
                  $StartPos = $id->getStartPos();
                  $Descriptn = $id->getDescriptn();
                  $CourseId = $id->getCourseId();
                  $MatchsId = $id->getMatchsId();
                  $MaxPoints = $id->getMaxPoints();
                  $MinRounds = $id->getMinRounds();
                  $TrgtPaper = $id->getTrgtPaper();
                  $TrgtPopper = $id->getTrgtPopper();
                  $TrgtPlates = $id->getTrgtPlates();
                  $TrgtPenlty = $id->getTrgtPenlty();
                  $Location = $id->getLocation();
                  $StringCnt = $id->getStringCnt();
                  $ReportOn = $id->getReportOn();
                  $IcsStageId = $id->getIcsStageId();
                  $Withdraw = $id->getWithdraw();
                  $TrgtVanish = $id->getTrgtVanish();   

                  $item = "<z:row 
                  MatchId='" . $MatchsId . "' 
                  StageId='" . $stagenumber . "' 
                  StageName='" . addslashes($stagename) . "' 
                  Location='" . addslashes($Location) . "' 
                  FirearmId='" . $FirearmId . "' 
                  CourseId='" . $CourseId . "' 
                  ScoringId='" . $ScoringId . "' 
                  TrgtTypeId='" . $TrgtTypeId . "' 
                  IcsStageId='" . $IcsStageId . "' 
                  Remove='" . $Withdraw . "' 
                  TrgtPaper='" . addslashes($TrgtPaper) . "' 
                  TrgtPopper='" . addslashes($TrgtPopper) . "' 
                  TrgtPlates='" . addslashes($TrgtPlates) . "' 
                  TrgtVanish='" . addslashes($TrgtVanish) . "' 
                  TrgtPenlty='" . addslashes($TrgtPenlty) . "' 
                  MinRounds='" . $MinRounds . "' 
                  ReportOn='" . $ReportOn . "' 
                  MaxPoints='" . $MaxPoints . "' 
                  StartPos='" . $StartPos . "' 
                  StartOn='" . addslashes($StartOn) . "' 
                  StringCnt='" . addslashes($StringCnt) . "' 
                  Descriptn='" . addslashes($Descriptn) . "'
                  />";  

                  $xml .= $item;
                }
                $xml .= "</rs:data></xml>"; 

                file_put_contents($file_stage, $xml);



                // XML match
                // dd($resultMatch);
               // dd($match->getMatchid()); 
                // $match_index_counts = 0;
                // $resultWinmssMatch = array();
                // foreach($match as $resultsMatch)
                // {
                //   $resultWinmssMatch[':match:'.$match_index_counts] = $resultsMatch;
                //   $match_index_counts++;
                // } 
                // dd($resultWinmssMatch);



                // $index_counts = 0;
                // $resultWinmssMatch = array();
                // foreach($resultMatch as $results)
                // {
                //   $resultWinmssMatch[':match_'.$index_counts] = $results->getMatchsId();
                //   // $index_counts++;
                // } 

                // dd($resultWinmssMatch);

                //  $file_out = "uploads/WinMSS/";//chemin de dépot de fichier generer
                // // dd($file_out);
                //  $filesystem = new Filesystem();

                //  if (!file_exists($file_out)) 
                //  {
                //   $filesystem->mkdir($file_out);
                // }
                // $dir = $file_out;
                // if (!file_exists($dir)) 
                // {
                //     // mkdir($dir);
                //   $filesystem->mkdir($dir, 0777);
                // }

                $file_match = $dir . "/THEMATCH.XML";

                $xml = "<xml xmlns:s='uuid:BDC6E3F0-6DA3-11d1-A2A3-00AA00C14882'
                xmlns:dt='uuid:C2F41010-65B3-11d1-A29F-00AA00C14882'
                xmlns:rs='urn:schemas-microsoft-com:rowset'
                xmlns:z='#RowsetSchema'>
                <s:Schema id='RowsetSchema'>
                <s:ElementType name='row' content='eltOnly' rs:updatable='true'>
                <s:AttributeType name='MatchId' rs:number='1' rs:maydefer='true' rs:writeunknown='true' rs:basetable='tblMatch'
                rs:basecolumn='MatchId' rs:keycolumn='true' rs:autoincrement='true'>
                <s:datatype dt:type='int' dt:maxLength='4' rs:precision='10' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='MatchName' rs:number='2' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatch' rs:basecolumn='MatchName'>
                <s:datatype dt:type='string' dt:maxLength='50'/>
                </s:AttributeType>
                <s:AttributeType name='MatchDt' rs:number='3' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatch' rs:basecolumn='MatchDt'>
                <s:datatype dt:type='dateTime' rs:dbtype='variantdate' dt:maxLength='16' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='ClubId' rs:number='4' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true' rs:basetable='tblMatch'
                rs:basecolumn='ClubId'>
                <s:datatype dt:type='i2' dt:maxLength='2' rs:precision='5' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='Chrono' rs:number='5' rs:maydefer='true' rs:writeunknown='true' rs:basetable='tblMatch'
                rs:basecolumn='Chronograph'>
                <s:datatype dt:type='boolean' dt:maxLength='2' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='MatchLevel' rs:number='6' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatch' rs:basecolumn='TypeMatchLevel'>
                <s:datatype dt:type='ui1' dt:maxLength='1' rs:precision='3' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='CountryId' rs:number='7' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatch' rs:basecolumn='TypeCountryId'>
                <s:datatype dt:type='string' dt:maxLength='3'/>
                </s:AttributeType>
                <s:AttributeType name='FirearmId' rs:number='8' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatch' rs:basecolumn='TypeFirearmId'>
                <s:datatype dt:type='ui1' dt:maxLength='1' rs:precision='3' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='SquadCount' rs:number='9' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true'
                rs:basetable='tblMatch' rs:basecolumn='SquadCount'>
                <s:datatype dt:type='ui1' dt:maxLength='1' rs:precision='3' rs:fixedlength='true'/>
                </s:AttributeType>
                <s:AttributeType name='MD' rs:number='10' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true' rs:basetable='tblMatch'
                rs:basecolumn='MatchDirector'>
                <s:datatype dt:type='string' dt:maxLength='40'/>
                </s:AttributeType>
                <s:AttributeType name='RM' rs:number='11' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true' rs:basetable='tblMatch'
                rs:basecolumn='RangeMaster'>
                <s:datatype dt:type='string' dt:maxLength='40'/>
                </s:AttributeType>
                <s:AttributeType name='SD' rs:number='12' rs:nullable='true' rs:maydefer='true' rs:writeunknown='true' rs:basetable='tblMatch'
                rs:basecolumn='StatsDirector'>
                <s:datatype dt:type='string' dt:maxLength='40'/>
                </s:AttributeType>
                <s:extends type='rs:rowbase'/>
                </s:ElementType>
                </s:Schema>
                <rs:data>";

                // dd($resultWinmssMatch);
                // 
                // $matchfile = $results->getMatchsId();
                //  dd($matchfile);

                // foreach ($matchfile as $idMatch) {
                // 
                
                // $resultWinmssStage->getMatchsId();
                 // dd($match->getname());
                  // foreach ($match as $idMatch) {

                  $matchsid = $match->getMatchid();                 
                  $name = $match->getname();            
                  $startAt = $match->getStartAt();          
                  $MatchLevel = $match->getMatchlevel();            
                  $CountryId = $match->getCountryId();            
                  $FirearmId = $match->getFirearmtype();            
                  $SquadCount = $match->getSquadCount();  
                  $MatchDirector = $match->getMatchDirector();
                  $RangeMaster = $match->getRangeMaster();
                  $StatsDirector = $match->getStatsDirector();                     

                  $item = "<z:row 
                  MatchId='" . $matchsid . "' 
                  Chrono='" . 'False' . "' 
                  MatchName='" . $name . "' 
                  MatchDt='" . $startAt . 'T00:00:00' . "' 
                  MatchLevel='" . $MatchLevel . "' 
                  CountryId='" . $CountryId . "' 
                  FirearmId='" . $FirearmId . "' 
                  SquadCount='" . $SquadCount . "'  
                  MD='" . $MatchDirector . "'
                  RM='" . $RangeMaster . "'
                  SD='" . $StatsDirector . "'          
                  />";  

                  $xml .= $item;
                // }                
                $xml .= "</rs:data></xml>"; 
                // dd($idMatch);

                file_put_contents($file_match, $xml);

                $path_files_xml = "uploads/WinMSS/"; //chemin des fichiers en xml
                $zipname = "WinMSS.zip"; //nom du fichier de sortie du zip
                $fileslist = scandir($path_files_xml); //scan la list des fichiers zip
                // dd($fileslist);

                $zip = new ZipArchive();// Charger la lib zip  
                // dd($zip);
                if ($zip->open("WinMSS.zip", ZIPARCHIVE::CREATE)) 
                {
                        foreach ($fileslist as $fileAll) // Boucle des filenames dans $file
                        {
                            $zip->addFile($path_files_xml.$fileAll, "$fileAll"); // Ajout d'un nom de fichier dans zip
                          }

                          dd($zip);
                          $zip->close();
                            //pousser pour télécharger le zip
                          header('Content-Transfer-Encoding: binary');
                          header('Content-Disposition: attachement; filename="WinMSS.zip"');
                          header('Content-type: application/zip');                
                          readfile("WinMSS.zip");                                   
                            unlink("WinMSS.zip"); //Supprimer le fichier zip existant dans le chemin temporaire
                            exit();
                          }

              
                // $zipname = "WinMSS.zip";
                // $zip = new ZipArchive();// Load zip librairy
                // $zip->open($zipname, ZIPARCHIVE::CREATE);

                //     // $finder = new Finder();
                //     // $finder->files()->in('/public/uploads/WinMSS');
                //     // $finder->path('uploads/WinMSS');
                //     // $finder->path('/WinMSS')->name('*.xml');
                //     // $finder->files()->name(['*.XML']);
                //     // dd($finder);
                // $path_files_xml = "uploads/WinMSS/";                
                // $filestest = scandir($path_files_xml);
                // // dd($filestest);
                // // unset($filestest[0], $filestest[1]);
                // foreach ($filestest as $fileAll)
                // {
                //   // $zip->addFile($fileAll, basename($fileAll)); // Adding filename into zip
                //   $zip->addFile($path_files_xml.$fileAll, "$fileAll"); // Ajout d'un nom de fichier dans zip
                //     }
                //     // dd($zip);
                //     $zip->close();
                //     //push to download the zip
                //     header('Content-Transfer-Encoding: binary');
                //     header('Content-Disposition: attachement; filename='.$zipname);
                //     header('Content-type: application/zip');        
                //     readfile($zipname);
                //         //Remove zip file is exists in temp path
                //     unlink($zipname);
                //     exit();

                      }
                    }
                    $this->addFlash('primary', 'WinMSS files successfully Downloaded !');
                    return $this->redirectToRoute('app_matchs');
                  }

                }