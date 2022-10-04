<?php

namespace App\Controller;

use App\Repository\LanguageRepository;
use App\Entity\Language;
use App\Form\LanguageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/language', name: 'language_')]
class LanguageController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function index(): Response
    {
        return $this->render('language/index.html.twig', [
            'controller_name' => 'LanguageController',
        ]);
    }

    #[Route('/add', name: 'add', methods: ['GET', 'POST'])]
    public function addDefinition(
        LanguageRepository $languageRepository,
        Request              $request
    ): Response
    {
        $language = new language();
        $form = $this->createForm(LanguageType::class, $language);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $languageRepository->save($language, true);

            return $this->redirectToRoute('app_home', [], Response::HTTP_CREATED);
        }

        return $this->renderForm('language/new.html.twig', [
            'form' => $form,
            'language' => $language
        ]);
    }
}
