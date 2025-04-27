<?php

namespace App\Controller;

use App\Entity\Ave;
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
        $user = $this->getUser();

        // Usuario no autenticado
        if (!$user) {
            return $this->render('home/index.html.twig', [
                'show_auth_links' => true
            ]);
        }

        // Verificación mejorada
        if (!method_exists($user, 'isVerified')) {
            throw new \RuntimeException('El método isVerified() no existe en la entidad Usuario');
        }

        // Usuario autenticado pero no verificado
        if (!$user->isVerified()) {
            return $this->render('home/index.html.twig', [
                'show_auth_links' => false,
                'unverified_warning' => true
            ]);
        }

        // Usuario verificado - Versión dashboard
        return $this->render('home/index.html.twig', [
            'show_auth_links' => false,
            'dashboard_mode' => true
        ]);
    }

    #[Route('/mapa-aves', name: 'app_mapa_aves')]
    public function mapaAves(): Response
    {
        return $this->render('home/mapa.html.twig');
    }

    #[Route('/aves-por-provincia', name: 'api_aves_provincia')]
    public function avesPorProvincia(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $provinciaNombre = $request->query->get('provincia');
        $periodo = $request->query->get('periodo', 'all');

        $query = $em->getRepository(Ave::class)
            ->createQueryBuilder('a')
            ->join('a.aveProvinciaPeriodos', 'app')
            ->join('app.provincia', 'p')
            ->join('app.periodo', 'periodo')
            ->where('p.nombre = :provincia')
            ->setParameter('provincia', $provinciaNombre);

        if ($periodo !== 'all') {
            $query->andWhere('periodo.tipo = :periodo')
                ->setParameter('periodo', $periodo);
        }

        $aves = $query->groupBy('a.id')
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