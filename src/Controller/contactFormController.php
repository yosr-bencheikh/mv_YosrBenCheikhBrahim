<?php

namespace App\Controller;

use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class contactFormController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $email = (new Email())
                ->from('yosrbencheikh28@example.com')
                ->to('yosrbencheikh28@gmail.com')
                ->subject('New Contact Form Submission')
                ->html("
                    <p><strong>Nom:</strong> {$formData['nom']}</p>
                    <p><strong>Email:</strong> {$formData['Email']}</p>
                    <p><strong>Mot de passe:</strong> {$formData['mot_de_passe']}</p>
                ");
            $mailer->send($email);
            $this->addFlash('success', 'Form submitted successfully!');
            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/formulaireContact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
