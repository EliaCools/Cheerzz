<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class AdministratorController
 * @package App\Controller
 * @isGranted("ROLE_ADMIN")
 */
class AdministratorController extends AbstractController
{
    #[Route('/administrator', name: 'administrator')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_BARTENDER', null, 'User tried to access this page without proper authorization!');
        return $this->render('administrator/index.html.twig', [
            'controller_name' => 'AdministratorController',
        ]);
    }
}
