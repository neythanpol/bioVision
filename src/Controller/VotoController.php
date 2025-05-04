<?php

namespace App\Controller;

use App\Entity\Foto;
use App\Entity\Voto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VotoController extends AbstractController
{
    #[Route('/votar/{id}', name: 'app_votar', methods: ['POST'])]
public function votar(Foto $foto, EntityManagerInterface $em, Request $request): JsonResponse
{
    $user = $this->getUser();
    if (!$user) {
        return $this->json(['error' => 'Debes estar logueado'], 401);
    }

    // Verificar si ya votó
    $existingVote = $em->getRepository(Voto::class)->findOneBy([
        'usuario' => $user,
        'foto' => $foto
    ]);

    if ($existingVote) {
        return $this->json(['error' => 'Ya has votado esta foto'], 400);
    }

    // Crear nuevo voto
    $voto = new Voto();
    $voto->setUsuario($user);
    $voto->setFoto($foto);
    $voto->setFecha(new \DateTime());

    $em->persist($voto);
    $em->flush();

    // Obtener conteo actualizado
    $totalVotos = $em->getRepository(Voto::class)->count(['foto' => $foto]);

    return $this->json([
        'success' => true,
        'totalVotos' => $totalVotos
    ]);
}
}
