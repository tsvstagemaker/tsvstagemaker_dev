<?php 

namespace App\Notification;

use App\Entity\Contact;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class MessageNotification{

	/**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * MailerService constructor.
     *
     * @param MailerInterface       $mailer
     * @param Environment   $twig
     */
	public function __construct(MailerInterface $mailer, Environment $twig)
	{
		$this->mailer = $mailer;
        $this->twig = $twig;
	}

	 /**
     * @param string $subject
     * @param string $from
     * @param string $to
     * @param string $template
     * @param array $parameters
     * @throws TransportExceptionInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
	public function sendEmail(Contact $contact)
    {

        $message = (new Email())
            ->from($contact->getEmail())
            ->to('tsvstagemaker@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            ->replyTo($contact->getEmail())
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Contact TSV STAGE MAKER!')
            // ->text('Sending emails is fun again!')
            // ->html('<p>See Twig integration for better HTML integration!</p>')
            ->html(
            	$this->twig->render('emails/sendEmail/sendEmailtemplate.html.twig',[
            		'contact' => $contact

            ]), 'text/html')
            ;

        $this->mailer->send($message);        
    }

	
}







