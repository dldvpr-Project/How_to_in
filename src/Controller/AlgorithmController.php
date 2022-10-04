<?php

namespace App\Controller;

use App\Entity\Algorithm;
use App\Form\AlgorithmType;
use App\Repository\AlgorithmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/algorithm', name: 'algorithm_')]
class AlgorithmController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function index(AlgorithmRepository $algorithmRepository): Response
    {
        $algorithmRepository->findAll();

        return $this->render('algorithm/index.html.twig', [
            'controller_name' => 'AlgorithmController',
        ]);
    }

    #[Route('/add', name: 'add', methods: ['POST', 'GET'])]
    public function add(Request $request, AlgorithmRepository $algorithmRepository): Response
    {
        $algorithm = new Algorithm();
        $form = $this->createForm(AlgorithmType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $algorithmRepository->save($algorithm, true);

            return $this->redirectToRoute('app_home', [], Response::HTTP_CREATED);
        }

        return $this->renderForm('algorithm/new.html.twig', [
            'algorithm' => $algorithm,
            'form' => $form
        ]);
    }
}
