<?php

namespace App\Message;

use App\Message\UserNotificationMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserNotificationHandlerController implements MessageHandlerInterface
{

	public function __construct (EntityManagerInterface $em){
		
	}

	

	public function __invoke(UserNotificationMessage $message){

	}

}
