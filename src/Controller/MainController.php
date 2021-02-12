<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Repository\StageRepository;

class MainController extends AbstractController
{
     /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'title' => "TSV STAGE MAKER",
            'current_menu' => "app_home",
        ]);
    }


    /**
     * @Route("/about", name="app_about")
     */
    public function about(): Response
    {
        return $this->render('main/about.html.twig', [
            'title' => "About",
            'current_menu' => "app_about",
            
            
        ]);
    }

    /**
     * @Route("/allstage", name="app_allstage")
     */
    public function allstage(Request $request, PaginatorInterface $paginator): Response
    {
       
        $datastages = $this->getDoctrine()->getRepository(Stage::class)->findBy(
            ['showall'=>true], 
            ['createdAt' => 'DESC']); 
           

        $stages = $paginator->paginate(
            $datastages,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('main/allstage.html.twig', [
            'title' => "Allstage",
            'current_menu' => "app_allstage",
            'stages' => $stages,
            
        ]);
    }

      /**
     * @Route("/template", name="app_template")
     */
    public function template_email(): Response
    {
        return $this->render('emails/template/template_email.html.twig');
    }
}
