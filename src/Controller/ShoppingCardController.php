<?php

namespace App\Controller;

use App\Entity\ShoppingCart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShoppingCardController extends AbstractController
{
    #[Route('/shopping/card', name: 'shopping_card')]
    public function index(): Response
    {
        return $this->render('shopping_card/index.html.twig', [
            'controller_name' => 'ShoppingCardController',
        ]);
    }
    #[Route('my/shopping/card', name: 'shopping_card')]
    public function shoppingCard(): Response
    {


        $user = $this->getUser();
        if($user->getSingleShoppingCart() === null){
            $shoppingCard = new ShoppingCart($user);
        }else{
            $shoppingCard = $user->getSingleShoppingCart();
        }

        return $this->render('shopping_card/index.html.twig', [
            'controller_name' => 'ShoppingCardController',
            'shopping_lines' => $shoppingCard->getShoppingLines()
        ]);
    }


}
