<?php

namespace App\Controller;

use App\Entity\Cocktail;
use App\Form\CocktailType;
use App\Model\CocktailApiClient;
use App\Repository\CocktailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cocktail')]
class CocktailController extends AbstractController
{
    private const ALPHABET = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0',];

    #[Route('/{firstCharacter}', name: 'cocktail_index', methods: ['GET'])]
    public function index(CocktailApiClient $cocktailClient, string $firstCharacter): Response
    {
        return $this->render('cocktail/index.html.twig', [
            'cocktails' => $cocktailClient->fetchCocktailsByFirstLetter($firstCharacter),
            'alphabet' => self::ALPHABET,
        ]);
    }

    #[Route('/new', name: 'cocktail_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $cocktail = new Cocktail();
        $form = $this->createForm(CocktailType::class, $cocktail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cocktail);
            $entityManager->flush();

            return $this->redirectToRoute('cocktail_index');
        }

        return $this->render('cocktail/new.html.twig', [
            'cocktail' => $cocktail,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/show', name: 'cocktail_show', methods: ['GET'])]
    public function show(int $id, CocktailApiClient $client): Response
    {
        return $this->render('cocktail/show.html.twig', [
            'cocktail' => $client->fetchCocktailById($id),
        ]);
    }

    #[Route('/{id}/edit', name: 'cocktail_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cocktail $cocktail): Response
    {
        $form = $this->createForm(CocktailType::class, $cocktail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cocktail_index');
        }

        return $this->render('cocktail/edit.html.twig', [
            'cocktail' => $cocktail,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/delete', name: 'cocktail_delete', methods: ['POST'])]
    public function delete(Request $request, Cocktail $cocktail): Response
    {
        if ($this->isCsrfTokenValid('delete' . $cocktail->getId(), $request->request->get('_token')))
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cocktail);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cocktail_index');
    }
}
