<?php

namespace App\Controller;

use App\Entity\Ave;
use App\Entity\Provincia;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/mapa-aves', name: 'app_mapa_aves')]
    public function mapaAves(): Response
    {
        return $this -> render('home/mapa.html.twig');
    }

    #[Route('/aves-por-provincia', name: 'api_aves_provincia')]
    public function avesPorProvincia(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $provinciaNombre = $request->query->get('provincia');

        $aves = $entityManager->getRepository(Ave::class)
            ->createQueryBuilder('a')
            ->join('a.aveProvinciaPeriodos', 'app')
            ->join('app.provincia', 'p')
            ->where('p.nombre = :provincia')
            ->setParameter('provincia', $provinciaNombre)
            ->groupBy('a.id')
            ->getQuery()
            ->getResult();

        $data = array_map(function(Ave $ave) {
            return [
                'nombreComun' => $ave->getNombreComun(),
                'nombreCientifico' => $ave->getNombreCientifico(),
                'imagen' => $ave->getImagenUrl()
            ];
        }, $aves);
        return $this->json($data);
    }
}
