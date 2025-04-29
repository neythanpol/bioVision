<?php

namespace App\Controller;

use App\Entity\Ave;
use App\Entity\Foto;
use App\Form\FotoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class UserController extends AbstractController
{
    #[Route('/mi-perfil', name: 'app_mi_perfil')]
    #[IsGranted('ROLE_USER')]
    public function miPerfil(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        $totalAves = $entityManager->getRepository(Ave::class)->count([]);
        $avesFotografiadas = $entityManager->getRepository(Foto::class)
            ->createQueryBuilder('f')
            ->select('COUNT(DISTINCT f.ave)')
            ->where('f.usuario = :usuario')
            ->setParameter('usuario', $user)
            ->getQuery()
            ->getSingleScalarResult();

        $fotosRecientes = $entityManager->getRepository(Foto::class)
            ->findBy(['usuario' => $user], ['fechaSubida' => 'DESC'], 5);

        return $this->render('user/perfil.html.twig', [
            'user' => $user,
            'stats' => [
                'totalAves' => $totalAves,
                'avesFotografiadas' => $avesFotografiadas,
                'porcentaje' => $totalAves > 0 ? round(($avesFotografiadas / $totalAves) * 100) : 2
            ],
            'fotosRecientes' => $fotosRecientes
        ]);
    }

    #[Route('/subir-foto', name: 'app_subir_foto')]
    #[IsGranted('ROLE_USER')]
    public function subirFoto(Request $request, EntityManagerInterface $entityManager): Response
    {
        $foto = new Foto();
        $form = $this->createForm(FotoType::class, $foto);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                try {
                    $foto->setUsuario($this->getUser());
                    $entityManager->persist($foto);
                    $entityManager->flush();
    
                    $this->addFlash('success', '¡Foto subida correctamente!');
                    return $this->redirectToRoute('app_mi_perfil');
                } catch (\Exception $e) {
                    $this->addFlash('error', 'Error al subir la foto: '.$e->getMessage());
                }
            } else {
                $this->addFlash('error', 'Por favor corrige los errores en el formulario');
            }
        }
    
        return $this->render('user/subir_foto.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/eliminar-foto/{id}', name: 'app_eliminar_foto', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function eliminarFoto(int $id, EntityManagerInterface $entityManager, Request $request): Response 
    {
        // Verificar token CSRF
        $submittedToken = $request->request->get('_token');
        if (!$this->isCsrfTokenValid('delete-foto'.$id, $submittedToken)) {
            $this->addFlash('error', 'Token CSRF inválido.');
            return $this->redirectToRoute('app_mi_perfil');
        }

        $foto = $entityManager->getRepository(Foto::class)->find($id);
        $usuario = $this->getUser();

        if (!$foto) {
            $this->addFlash('error', 'La foto no existe.');
            return $this->redirectToRoute('app_mi_perfil');
        }

        if ($foto->getUsuario() !== $usuario) {
            $this->addFlash('error', 'No tienes permiso para eliminar esta foto.');
            return $this->redirectToRoute('app_mi_perfil');
        }

        try {
            // Eliminar archivo físico
            $filePath = $this->getParameter('kernel.project_dir').'/public'.$foto->getUrlRelativa();

            if (file_exists($filePath)) {
                if (!unlink($filePath)) {
                    throw new \RuntimeException('No se pudo eliminar el archivo físico.');
                }
            }

            $entityManager->remove($foto);
            $entityManager->flush();

            $this->addFlash('success', 'Foto eliminada correctamente.');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Error al eliminar la foto: '.$e->getMessage());
        }
            return $this->redirectToRoute('app_mi_perfil');
    }
}
