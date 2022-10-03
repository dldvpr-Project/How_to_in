<?php

namespace App\Controller;

use App\Repository\DefinitionRepository;
use Exception;
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

            return $this->redirectToRoute('app_home', [], Response::HTTP_CREATED);
        }

        return $this->renderForm('definition/new.html.twig', [
            'form' => $form,
            'definition' => $definition
        ]);
    }

    #[Route('/(id)', name: 'delete', methods: ['POST'])]
    public function deleteDefinition(Request $request, DefinitionRepository $definitionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $definition->getId(), $request->request->get('_token'))) {
            $definitionRepository->remove($definition, true);
        } else {
            throw new \RuntimeException('Impossible de supprimer la definition.');
        }
        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }



}
