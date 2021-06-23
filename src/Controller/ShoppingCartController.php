<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderLine;
use App\Entity\ShoppingCart;
use App\Entity\User;
use App\Repository\ProductRepository;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @IsGranted("ROLE_USER")
 */
class ShoppingCartController extends AbstractController
{

    #[Route('my/shoppingcart', name: 'my_shopping_cart')]
    public function shoppingCard(ProductRepository $productRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /** @var User $user */
        $user = $this->getUser();
        $products = $productRepository->findAll();
        $bartender = $productRepository->findOneBy(['name' => 'Bartender Service']);

        $shoppingCart = new ShoppingCart($user);

        if($user->getSingleShoppingCart()){
            $shoppingCart = $user->getSingleShoppingCart();

        }


        return $this->render('shopping_card/index.html.twig', [
            'controller_name' => 'ShoppingCardController',
            'shopping_lines' => $shoppingCart->getShoppingLines(),
            'product' => $products,
            'shoppingCart' => $shoppingCart,
            'bartender' => $bartender

        ]);
    }

    #[Route('order', name: 'process_order', methods: ['POST'])]
    public function order(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /** @var User $user */
        $user = $this->getUser();


        $shoppingCart = $user->getSingleShoppingCart();

        $order = new Order($user, new DateTime('now'));

        foreach($shoppingCart->getShoppingLines() as $shoppingLine){

            $order->addOrderLine(new OrderLine($shoppingLine->getProduct(),
                                                $shoppingLine->getQuantity(),
                                                $shoppingLine->calculatePrice($shoppingLine->getProduct())));

        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($shoppingCart);
        $entityManager->persist($order);
        $entityManager->flush();

        $this->addFlash(
            'order',
            'Your order has been processed!'
        );

        return $this->redirectToRoute('home');

    }

}
