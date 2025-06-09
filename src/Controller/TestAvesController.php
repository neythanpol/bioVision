<?php

namespace App\Controller;

use App\Repository\AveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestAvesController extends AbstractController
{
    #[Route('/lista-aves', name: 'app_list_aves')]
    public function list(AveRepository $aveRepository): Response
    {
        $aves = $aveRepository->findAll();
        
        return $this->render('lista_aves/list.html.twig', [
            'aves' => $aves
        ]);
    }
}