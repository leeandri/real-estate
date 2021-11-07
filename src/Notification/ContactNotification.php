<?php
namespace App\Notification;

use App\Entity\Contact;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class ContactNotification{

    public function __construct(MailerInterface $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }
//    public function notify(Contact $contact){
//        $message = (new \Swift_Message('Agency : ' . $contact->getProperty()->getTitle()))
//            ->setFrom('noreply@agency.com')
//            ->setTo('rlee.andri@gmail.com')
//            ->setReplyTo($contact->getEmail())
//            ->setBody($this->renderer->render('emails/contact.html.twig', [
//                'contact' => $contact
//            ]), 'text/html');
//
//        $this->mailer->send($message);
//
//        // ...
//    }


    /**
     * @param Contact $contact
     */
    public function notify(Contact $contact)
    {
        $email = (new Email())
            ->from('noreply@client.exemple.com')
            ->to('contact@nexter-agency.exemple.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            ->replyTo($contact->getEmail())
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Request contact about : ' . $contact->getProperty()->getTitle())
            ->html($this->renderer->render('emails/contact.html.twig', [
                'contact' => $contact
            ]));

        $this->mailer->send($email);

        // ...
    }
}