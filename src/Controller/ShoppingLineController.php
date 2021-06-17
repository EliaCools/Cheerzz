<?php

namespace App\Controller;

use App\Entity\ShoppingCart;
use App\Entity\ShoppingLine;
use App\Form\ShoppingLineType;
use App\Repository\ProductRepository;
use App\Repository\ShoppinglineRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shopping/line')]
class ShoppingLineController extends AbstractController
{

    private ProductRepository $productRepository;
    private ShoppinglineRepository $shoppinglineRepository;

    public function __construct(ShoppinglineRepository $shoppinglineRepository, ProductRepository $productRepository)
    {
        $this->shoppinglineRepository = $shoppinglineRepository;
        $this->productRepository = $productRepository;
    }

    #[Route('/', name: 'shopping_line_index', methods: ['GET'])]
    public function index(ShoppinglineRepository $shoppinglineRepository): Response
    {
        return $this->render('shopping_line/index.html.twig', [
            'shopping_lines' => $shoppinglineRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'shopping_line_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $productId = $request->get('product');
        $quantity = $request->get('quantity');
        $user = $this->getUser();

        if($this->shoppinglineRepository->findOneBy(['product'=> $productId])){

            $shoppingLine = $this->shoppinglineRepository->findOneBy(['product'=> $productId, ['use']]);
            $current = $shoppingLine->getQuantity();
            $current += $quantity;
            $shoppingLine->setQuantity($current);

        }else{
            $shoppingLine = new ShoppingLine();
            $shoppingLine->setProduct($this->productRepository->findOneBy(['id'=> $productId]));
            $shoppingLine->setQuantity($quantity);
        }



     //   $form = $this->createForm(ShoppingLineType::class, $shoppingLine);
     //   $form->handleRequest($request);



        if($user->getSingleShoppingCart() === null){
            $shoppingCard = new ShoppingCart($user);
        }else{
            $shoppingCard = $user->getSingleShoppingCart();
        }





            $shoppingLine->setShoppingCart($shoppingCard);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($shoppingLine);
            $entityManager->flush();

            return $this->redirectToRoute('shopping_line_index');

    }

    #[Route('/{id}', name: 'shopping_line_show', methods: ['GET'])]
    public function show(ShoppingLine $shoppingLine): Response
    {
        return $this->render('shopping_line/show.html.twig', [
            'shopping_line' => $shoppingLine,
        ]);
    }

    #[Route('/{id}/edit', name: 'shopping_line_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ShoppingLine $shoppingLine): Response
    {
        $form = $this->createForm(ShoppingLineType::class, $shoppingLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shopping_line_index');
        }

        return $this->render('shopping_line/edit.html.twig', [
            'shopping_line' => $shoppingLine,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'shopping_line_delete', methods: ['POST'])]
    public function delete(Request $request, ShoppingLine $shoppingLine): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shoppingLine->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($shoppingLine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('shopping_line_index');
    }
}
