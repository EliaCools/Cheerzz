<?php

namespace App\Controller;

use App\Entity\HomeBrew;
use App\Entity\User;
use App\Form\HomeBrewType;
use App\Repository\HomeBrewRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class HomeBrewController
 * @package App\Controller
 * @IsGranted("ROLE_USER")
 */
#[Route('/home/brew')]
class HomeBrewController extends AbstractController
{
    /**
     * @param HomeBrewRepository $homeBrewRepository
     * @return Response
     */
    #[Route('/', name: 'home_brew_index', methods: ['GET'])]
    public function index(HomeBrewRepository $homeBrewRepository): Response
    {
        $myCocktails = $homeBrewRepository->findBy(['madeBy'=> $this->getUser() ]);
        foreach ($myCocktails as $cocktail)
        {
            $ingredients = [];
            foreach ($cocktail->getIngredientsAndMeasurements() as $ingredientsAndMeasurement)
            {
                if(empty($ingredientsAndMeasurement[0]))
                {
                    break;
                }
                $ingredients[] = $ingredientsAndMeasurement;
            }
            $cocktail->setIngredientsAndMeasurements($ingredients);
        }

        return $this->render('home_brew/index.html.twig', [
            'home_brews' => $myCocktails,
        ]);
    }


    #[Route('/new', name: 'home_brew_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        /**
         * @var User $user
         */
        $user = $this->getUser();
        $homeBrew = new HomeBrew($user);

        $form = $this->createForm(HomeBrewType::class, $homeBrew);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $homeBrew->formatIngredientsAndMeasurements();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($homeBrew);
            $entityManager->flush();

            return $this->redirectToRoute('home_brew_index');
        }

        return $this->render('home_brew/new.html.twig', [
            'home_brew' => $homeBrew,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'home_brew_show', methods: ['GET'])]
    public function show(HomeBrew $homeBrew, ProductRepository $productRepository): Response
    {
        $products = [];
        if (isset($homeBrew))
        {
            foreach ($homeBrew->getIngredientsAndMeasurements() as $ingredient)
            {
                $name = $ingredient[0];
                $measurement = $ingredient[1];
                $products[] = [
                    'name' => $name,
                    'measurement' => $measurement,
                    'id' => $productRepository->findByProductName($name)->getId(),
                ];
            }
        }

        return $this->render('home_brew/show.html.twig', [
            'home_brew' => $homeBrew,
            'products'=>$products,
        ]);
    }

    #[Route('/{id}/edit', name: 'home_brew_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, HomeBrew $homeBrew): Response
    {
        $homeBrew->formatIngredientsToForm();
        $form = $this->createForm(HomeBrewType::class, $homeBrew);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home_brew_index');
        }

        return $this->render('home_brew/edit.html.twig', [
            'home_brew' => $homeBrew,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'home_brew_delete', methods: ['POST'])]
    public function delete(Request $request, HomeBrew $homeBrew): Response
    {
        if ($this->isCsrfTokenValid('delete'.$homeBrew->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($homeBrew);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home_brew_index');
    }
}
