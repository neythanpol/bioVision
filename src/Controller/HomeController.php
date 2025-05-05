<?php

namespace App\Controller;

use App\Entity\Foto;
use App\Entity\Ave;
use App\Repository\ArticuloRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager, ArticuloRepository $articuloRepository): Response
    {
        $user = $this->getUser();

        // Para usuarios no autenticados
        if (!$user) {
            return $this->render('home/index.html.twig', [
                'show_auth_links' => true,
                'meta_description' => 'Plataforma de observación y fotografía de aves. Regístrate para comenzar a documentar avistamientos.'
            ]);
        }

        // Para usuarios no verificados
        if (!$user->isVerified()) {
            return $this->render('home/index.html.twig', [
                'unverified_warning' => true,
                'meta_description' => 'Por favor verifica tu email para acceder a todas las funciones de BioVision.'
            ]);
        }

        // Obtener las 5 fotos más votadas para el carrusel
        $fotosMasVotadas = $entityManager->getRepository(Foto::class)
        ->createQueryBuilder('f')
        ->select('f', 'COUNT(v.id) as voteCount')
        ->leftJoin('f.votos', 'v')
        ->groupBy('f.id')
        ->orderBy('voteCount', 'DESC')
        ->addOrderBy('f.fechaSubida', 'DESC')
        ->setMaxResults(5)
        ->getQuery()
        ->getResult();

        // Extraer solo los objetos Foto del resultado
        $fotosParaCarrusel = array_column($fotosMasVotadas, 0);

        // Si no hay suficientes fotos votadas, completamos con las más recientes
        if (count($fotosParaCarrusel) < 5) {
            $faltantes = 5 - count($fotosParaCarrusel);
            $fotosRecientes = $entityManager->getRepository(Foto::class)
                ->findBy([], ['fechaSubida' => 'DESC'], $faltantes);
            
            $fotosParaCarrusel = array_merge($fotosParaCarrusel, $fotosRecientes);
        }

        // Obtener ave del día
        $aveDelDia = $this->getAveDelDia($entityManager);

        // Obtener estadísticas del usuario
        $stats = $this->getUserStats($entityManager, $user);

        $ultimasFotos = $entityManager->getRepository(Foto::class)
            ->findBy([], ['fechaSubida' => 'DESC'], 20);

        // Obtener los últimos 3 artículos ordenados por fecha de publicación descendente
        $articulosRecientes = $articuloRepository->findLatestArticles(3);

        return $this->render('home/index.html.twig', [
            'fotosParaCarrusel' => $fotosParaCarrusel,
            'aveDelDia' => $aveDelDia,
            'stats' => $stats,
            'dashboard_mode' => true,
            'meta_description' => 'Tu panel de control de BioVision. Explora el mapa de aves y tus observaciones.',
            'ultimasFotos' => $ultimasFotos,
            'articulosRecientes' => $articulosRecientes
        ]);
    }

    private function getAveDelDia(EntityManagerInterface $entityManager): ?Ave
    {
        $aves = $entityManager->getRepository(Ave::class)->findAll();

        if (empty($aves)) {
            return null;
        }

        // Selección aleatoria
        return $aves[array_rand($aves)];
    }

    private function getUserStats(EntityManagerInterface $entityManager, $user): array
    {
        $totalAves = $entityManager->getRepository(Ave::class)->count([]);
        $avesFotografiadas = $entityManager->getRepository(Foto::class)
            ->createQueryBuilder('f')
            ->select('COUNT(DISTINCT f.ave)')
            ->where('f.usuario = :usuario')
            ->setParameter('usuario', $user)
            ->getQuery()
            ->getSingleScalarResult();

        return [
            'totalAves' => $totalAves,
            'avesFotografiadas' => $avesFotografiadas,
            'porcentaje' => $totalAves > 0 ? round(($avesFotografiadas / $totalAves) * 100) : 0
        ];
    }

    #[Route('/mapa-aves', name: 'app_mapa_aves')]
    public function mapaAves(): Response
    {
        return $this->render('home/mapa.html.twig', [
            'meta_description' => 'Mapa interactivo de distribución de aves por provincias y periodos del año.'
        ]);
    }

    #[Route('/aves-por-provincia', name: 'api_aves_provincia')]
    public function avesPorProvincia(Request $request, EntityManagerInterface $em): JsonResponse
    {
        try {
            $provinciaNombre = $request->query->get('provincia');
            $periodo = $request->query->get('periodo', 'all');
            
            if (!$provinciaNombre) {
                throw new \InvalidArgumentException('Nombre de provincia no proporcionado');
            }

            $query = $em->getRepository(Ave::class)
                ->createQueryBuilder('a')
                ->select('a', 'app', 'p', 'periodo')
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

        } catch (\Exception $e) {
            return $this->json([
                'error' => 'Error al cargar las aves: ' . $e->getMessage()
            ], 500);
        }
    }
}