<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $user = $this -> getUser();

        // Usuario no autenticado
        if (!$user) {
            // Si el usuario no está autenticado, redirigir a la página de inicio de sesión
            // o mostrar enlaces de autenticación
            return $this -> render('home/index.html.twig', [
                'show_auth_links' => true
            ]);
        }

        // Verificación mejorada
        if (!method_exists($user, 'isVerified')) {
            throw new \RuntimeException('El método isVerified() no existe en la entidad Usuario');
        }

        // Usuario autenticado pero no verificado
        if (!$user -> isVerified()) {
            return $this -> render('home/index.html.twig', [
                'show_auth_links' => false,
                'unverified_warning' => true
            ]);
        }

        // Usuario verificado - Versión dashboard
        return $this -> render('home/index.html.twig', [
            'show_auth_links' => false,
            'dashboard_mode' => true
        ]);
    }
}
