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

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $shoppingCart = null;

        /** @var User $user */
        $user = $this->getUser();

        if($user !== null){
            $shoppingCart = $user->getSingleShoppingCart();
        }


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'shoppingCart' => $shoppingCart
        ]);
    }
    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('/contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/about_us', name: 'about_us')]
    public function about(): Response
    {
        return $this->render('/about.html.twig');
    }
}
