<?php

namespace App\Controller;

use App\Entity\Articulo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArticuloController extends AbstractController
{
    #[Route('/articulos', name: 'app_articulos')]
    public function index(EntityManagerInterface $em): Response
    {
        $articulos = $em->getRepository(Articulo::class)->findBy(
            [],
            ['fechaPublicacion' => 'DESC']
        );

        return $this->render('articulo/index.html.twig', [
            'articulos' => $articulos
        ]);
    }

    #[Route('/articulos/{slug}', name: 'app_articulo_show')]
    public function show(string $slug, EntityManagerInterface $em): Response
    {
        $articulo = $em->getRepository(Articulo::class)->findOneBy(['slug' => $slug]);
        
        if (!$articulo) {
            throw $this->createNotFoundException('Artículo no encontrado');
        }

        return $this->render('articulo/show.html.twig', [
            'articulo' => $articulo
        ]);
    }
}