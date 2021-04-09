<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Produit;
use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="main_index", methods={"GET"})
     */
    public function index(): Response
    {

        return $this->render('admin/main.html.twig', [
            'produits' => $produits = $this->getDoctrine()->getRepository(Produit::class)->findAll()
        ]);
    }


}