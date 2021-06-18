<?php

namespace App\Controller;

use App\Entity\ShoppingCart;
use App\Entity\ShoppingLine;
use App\Entity\User;
use App\Form\ShoppingLineType;
use App\Repository\ProductRepository;
use App\Repository\ShoppinglineRepository;
use App\Repository\UserRepository;
use App\Service\ShoppingLinePreparer;
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

    #[Route('/new', name: 'shopping_line_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /** @var User $user */
        $user = $this->getUser();

        $productId = $request->get('product');
        $quantity = $request->get('quantity');
        $isEdit = $request->get('isEdit');

        $shoppingCart = new ShoppingCart($user);
        $dbShoppingCartId = null;

        if($user->getSingleShoppingCart()){
            $shoppingCart = $user->getSingleShoppingCart();
            $dbShoppingCartId = $user->getSingleShoppingCart()->getId();
        }


        $shoppingLinePreparer = new ShoppingLinePreparer($this->shoppinglineRepository, $this->productRepository);
        $shoppingLine = $shoppingLinePreparer->prepareShoppingLine($productId, $dbShoppingCartId, $quantity, $isEdit);


            $shoppingLine->setShoppingCart($shoppingCart);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($shoppingLine);
            $entityManager->flush();

        $this->addFlash(
            'notice',
            'successfully added to your shopping cart'
        );


            return $this->redirectToRoute('product_index');

    }

    #[Route('/{id}', name: 'shopping_line_delete', methods: ['POST'])]
    public function delete(Request $request, ShoppingLine $shoppingLine): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shoppingLine->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($shoppingLine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('my_shopping_cart');
    }
}
