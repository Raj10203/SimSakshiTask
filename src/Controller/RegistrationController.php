<?php

namespace App\Controller;

use App\Entity\CompanyUser;
use App\Entity\NormalUser;
use App\Entity\User;
use App\Form\RegistrationForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register/{type}', name: 'app_register')]
    public function register(string                      $type,
                             Request                     $request,
                             UserPasswordHasherInterface $userPasswordHasher,
                             EntityManagerInterface      $entityManager): Response
    {
        if($type === 'company') {
            $user = new CompanyUser();
            $user->setRoles(['ROLE_COMPANY']);
        } else {
            $user = new NormalUser();
            $user->setRoles(['ROLE_NON_COMPANY']);
        }
        $form = $this->createForm(RegistrationForm::class, $user, [
            'type' => $type === 'company',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();

            // encode the plain password
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
            'type' => $type,
        ]);
    }

    #[Route('/register', name: 'app_register_home')]
    public function registerHome(): Response
    {
        return $this->render('registration/home.html.twig');
    }

}
