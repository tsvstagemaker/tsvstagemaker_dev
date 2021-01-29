<?php

namespace App\Controller\Admin;

use App\Entity\Matchs;
use App\Entity\Stage;
use App\Entity\User;

use App\Repository\MatchsRepository;
use App\Repository\StageRepository;
use App\Repository\UserRepository;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Controller\DashboardControllerInterface;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;



class DashboardController extends AbstractDashboardController
{

    protected $StageRepository;
    protected $MatchsRepository;
    protected $UserRepository;
/**
 * [__construct description]
 * @param StageRepository $StageRepository [description]
 * @param MatchsRepository $MatchsRepository [description]
 * @param UserRepository   $UserRepository   [description]
 */
    public function __construct(

        StageRepository $StageRepository,
        MatchsRepository $MatchsRepository,
        UserRepository $UserRepository
    )        
    
    {
       $this->StageRepository = $StageRepository;
       $this->MatchsRepository = $MatchsRepository;
       $this->UserRepository = $UserRepository;
    }


    /**
     * @Route("/admin", name="admin")
     * @Security("is_granted('ROLE_SUPER_ADMIN')")
     */
    public function index(): Response
    {
         return $this->render('bundles/EasyAdminBundle/welcome.html.twig', [
            'countAllUsers' => $this->UserRepository->countAllUsers(),
            'showtAllUsers' => $this->UserRepository->findAll(),

            'countAllMatchs' => $this->MatchsRepository->countAllMatchs(),
            'showAllMatchs' => $this->MatchsRepository->findAll(),

            'countAllStages' => $this->StageRepository->countAllStages(),
            'showAllStages' => $this->StageRepository->findAll(),
        ]);         
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('TSV STAGE MAKER');
    }

     public function configureAssets(): Assets
    {
        return Assets::new()
            ->addCssFile('bundles/easyadmin/css/styleAdmin.css');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Matchs', 'fas fa-list', Matchs::class);
        yield MenuItem::linkToCrud('Stages', 'fas fa-list-ol', Stage::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu 
      { 
        return parent::configureUserMenu($user)
        ->setName($user->getUsername())
        ->setName($user->getUsername())
        // ->setGravatarEmail($user->getUserame())
        ->setAvatarUrl('https://www.tsvstagemaker.fr/images/logo_navbar.png')
        ->displayUserAvatar(true)

        ->addMenuItems([
                MenuItem::linkToRoute('Home', 'fas fa-home', 'app_home', ['...' => '...']),       
                // MenuItem::section(),
                // MenuItem::linkToLogout('Logout', 'fa fa-sign-out'),
            ]);
        
      }


}
