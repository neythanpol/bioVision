<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\RegistrationFormType;
use App\Security\AppAuthenticator;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    public function __construct(private EmailVerifier $emailVerifier)
    {
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new Usuario();
        $form = $this->createForm(RegistrationFormType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Verificar si el email ya existe
            $plainPassword = $form->get('plainPassword')->getData();

            // Codificar la contraseña y asignarla
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $plainPassword
                )
            );
            $existingUser = $entityManager->getRepository(Usuario::class)->findOneBy(['email' => $user->getEmail()]);
            if ($existingUser) {
                $this->addFlash('error', 'Este email ya está registrado');
                return $this->redirectToRoute('app_register');
            }

            // Codificar la contraseña
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // Establecer roles y fecha
            $user->setRoles(['ROLE_USER']);
            $user->setCreated(new \DateTime());

            $entityManager->persist($user);
            $entityManager->flush();

            // Enviar email de confirmación
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('no-reply@biovision.com', 'BioVision Mail Bot'))
                    ->to((string) $user->getEmail())
                    ->subject('Por favor, confirma tu email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            $this->addFlash('success', 'Se ha enviado un enlace de confirmación a tu email. Por favor, verifica tu cuenta.');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Comentar esta línea para permitir el acceso a la página sin autenticación
        // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            // Obtener el usuario desde el token (si es necesario)
            $user = $this->getUser();
            if (!$user instanceof Usuario) {
                throw new \Exception('Usuario no autenticado o no válido');
            }

            // El método handleEmailConfirmation() se encarga de verificar el token y establecer el estado de verificación del usuario. Lo obtiene desde el token
            $this->emailVerifier->handleEmailConfirmation($request, $user);

            // Añadir un mensaje de éxito
            $this->addFlash('success', '¡Tu correo electrónico ha sido verificado correctamente!');

            // Redirigir a la página de inicio
            return $this->redirectToRoute('app_home');
        } catch (VerifyEmailExceptionInterface $exception) {
            // Manejar errores de verificación
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }
    }
}
