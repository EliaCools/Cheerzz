<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ShoppingLine;
use App\Entity\User;
use App\Form\ProductType;
use App\Form\ShoppingLineType;
use App\Model\CocktailApiClient;
use App\Repository\ProductRepository;
use http\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/product')]
class ProductController extends AbstractController
{
    #[Route('/', name: 'product_index', methods: ['GET'])]
    public function index(ProductRepository $productRepository, Request $request): Response
    {

        $shoppingCart = null;

        /** @var User $user */
        $user = $this->getUser();

        if($user !== null){
            $shoppingCart = $user->getSingleShoppingCart();
        }


        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
            'shoppingCart' => $shoppingCart,

        ]);
    }

    #[Route('/new', name: 'product_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
            'user' => $this->getUser()
        ]);
    }

    #[Route('/{id}', name: 'product_detailed', methods: ['GET'])]
    public function show(Product $product): Response
    {
        return $this->render('product/product_details.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/{id}/edit', name: 'product_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'product_delete', methods: ['POST'])]
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_index');
    }




}
