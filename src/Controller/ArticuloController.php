<?php

namespace App\Controller;

use App\Entity\Articulo;
use App\Form\ArticuloType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/articulos')]
class ArticuloController extends AbstractController
{
    #[Route('/', name: 'app_articulos', methods: ['GET'])]
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

    #[Route('/nuevo', name: 'app_articulo_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $articulo = new Articulo();
        $form = $this->createForm(ArticuloType::class, $articulo);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articulo->setAutor($this->getUser());
            $articulo->setFechaPublicacion(new \DateTime());
            
            $em->persist($articulo);
            $em->flush();

            $this->addFlash('success', 'Artículo creado correctamente');
            return $this->redirectToRoute('app_articulo_show', ['slug' => $articulo->getSlug()]);
        }

        return $this->render('articulo/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{slug}/editar', name: 'app_articulo_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, string $slug, EntityManagerInterface $em): Response
    {
        $articulo = $em->getRepository(Articulo::class)->findOneBy(['slug' => $slug]);
        
        if (!$articulo) {
            throw $this->createNotFoundException('Artículo no encontrado');
        }

        $form = $this->createForm(ArticuloType::class, $articulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            $this->addFlash('success', 'Artículo actualizado correctamente');
            return $this->redirectToRoute('app_articulo_show', ['slug' => $articulo->getSlug()]);
        }

        return $this->render('articulo/edit.html.twig', [
            'articulo' => $articulo,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{slug}/eliminar', name: 'app_articulo_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, string $slug, EntityManagerInterface $em): Response
    {
        $articulo = $em->getRepository(Articulo::class)->findOneBy(['slug' => $slug]);
        
        if (!$articulo) {
            $this->addFlash('error', 'Artículo no encontrado');
            return $this->redirectToRoute('app_articulos');
        }

        $submittedToken = $request->request->get('_token');
        
        if (!$this->isCsrfTokenValid('delete'.$articulo->getId(), $submittedToken)) {
            $this->addFlash('error', 'Token CSRF inválido');
            return $this->redirectToRoute('app_articulo_show', ['slug' => $slug]);
        }

        $em->remove($articulo);
        $em->flush();
        
        $this->addFlash('success', 'Artículo eliminado correctamente');
        return $this->redirectToRoute('app_articulos');
    }
    
    #[Route('/{slug}', name: 'app_articulo_show', methods: ['GET'])]
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