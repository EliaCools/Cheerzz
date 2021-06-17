<?php

namespace App\Controller;

use App\Entity\ShoppingCart;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShoppingCartController extends AbstractController
{
    #[Route('/shopping/cart', name: 'shopping_cart')]
    public function index(): Response
    {
        return $this->render('shopping_card/index.html.twig', [
            'controller_name' => 'ShoppingCardController',
        ]);
    }
    #[Route('my/shoppingcart', name: 'my_shopping_cart')]
    public function shoppingCard(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /** @var User $user */
        $user = $this->getUser();

        $shoppingCard = new ShoppingCart($user);

        if($user->getSingleShoppingCart()){
            $shoppingCard = $user->getSingleShoppingCart();
        }

        return $this->render('shopping_card/index.html.twig', [
            'controller_name' => 'ShoppingCardController',
            'shopping_lines' => $shoppingCard->getShoppingLines()
        ]);
    }


}
