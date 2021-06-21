<?php

namespace App\Controller;

use App\Entity\User;
use App\Model\YoutubeApiClient;
use App\Repository\ShoppingcartRepository;
use App\Repository\ShoppinglineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private ShoppingLineRepository $shoppingLineRepository;
    private ShoppingCartRepository $shoppingCartRepository;


    /**
     * HomeController constructor.
     * @param ShoppinglineRepository $shoppingLineRepository
     * @param ShoppingcartRepository $shoppingCartRepository
     */
    public function __construct(ShoppinglineRepository $shoppingLineRepository, ShoppingcartRepository $shoppingCartRepository)
    {
        $this->shoppingLineRepository = $shoppingLineRepository;
        $this->shoppingCartRepository = $shoppingCartRepository;
    }


    #[Route('/', name: 'home')]
    public function index(): Response
    {
//        /** @var User $user */
//        $user = $this->getUser();
//
//       $shoppingCart = $user->getSingleShoppingCart();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            //'shoppingCart' => $shoppingCart
        ]);
    }
    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('/contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
