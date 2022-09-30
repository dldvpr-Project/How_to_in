<?php

namespace App\Controller;

use App\Repository\DefinitionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Definition;
use App\Form\DefinitionType;

#[Route('/definition', name: 'definition_')]
class DefinitionController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function index(): Response
    {
        return $this->render('definition/index.html.twig', [
            'controller_name' => 'DefinitionController',
        ]);
    }

    #[Route('/addDefinition', name: 'add', methods: ['GET', 'POST'])]
    public function addDefinition(
        DefinitionRepository $definitionRepository,
        Request              $request
    ): Response
    {
        $definition = new definition();
        $form = $this->createForm(DefinitionType::class, $definition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $definitionRepository->save($definition, true);

            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('definition/new.html.twig', [
            'form' => $form,
            'definition' => $definition
        ]);
    }
}
