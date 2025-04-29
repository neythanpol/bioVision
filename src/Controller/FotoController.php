<?php

namespace App\Controller;

use App\Entity\Foto;
use App\Entity\Ave;
use App\Form\FotoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class FotoController extends AbstractController
{
    #[Route('/ave/{id}/subir-foto', name: 'app_subir_foto')]
    #[IsGranted('ROLE_USER')]
    public function subirFoto(Request $request, EntityManagerInterface $entityManager, Ave $ave): Response
    {
        $foto = new Foto();
        $foto->setUsuario($this->getUser());
        $foto->setAve($ave);

        $form = $this->createForm(FotoType::class, $foto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($foto);
            $entityManager->flush();

            $this->addFlash('success', 'Foto subida correctamente.');
            return $this->redirectToRoute('app_foto_detalle', ['id' => $foto->getId()]);
        }

        return $this->render('foto/subir.html.twig', [
            'form' => $form->createView(),
            'ave' => $ave,
            'fotos_existentes' => $ave->getFotos()
        ]);
    }

    #[Route('/foto/{id}', name: 'app_foto_detalle')]
    public function detalle(Foto $foto): Response
    {
        return $this->render('foto/detalle.html.twig', [
            'foto' => $foto
        ]);
    }

    #[Route('/mis-fotos', name: 'app_mis_fotos')]
    #[IsGranted('ROLE_USER')]
    public function misFotos(EntityManagerInterface $entityManager): Response
    {
        $fotos = $entityManager->getRepository(Foto::class)->findBy([
            'usuario' => $this->getUser()
        ], ['fechaSubida' => 'DESC']);

        return $this->render('foto/detalle.html.twig', [
            'fotos' => $fotos
        ]);
    }
}
