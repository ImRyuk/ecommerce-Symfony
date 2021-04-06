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

class MainController extends AbstractController
{

    /**
     * @Route("/", name="main")
     */
    public function index(): Response
    {

        return $this->render('main.html.twig', [
            'produits' => $produits = $this->getDoctrine()->getRepository(Produit::class)->findAll()
        ]);
    }

    public function Navbar(SessionInterface $session, CartService $cartService): Response
    {
        return $this->render('navbar.html.twig', [
            'categories' => $this->getDoctrine()->getRepository(Categorie::class)->findAll(),
            'total' => $cartService->getQuantity()
        ]);
    }

    /**
     * @Route("/cart", name="cart")
     * @param CartService $cartService
     * @return Response
     */
    public function cart(CartService $cartService)
    {
        return $this->render('cart.html.twig', [
            'items' => $cartService->getFullCart(),
            'total' => $cartService->getTotal()
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="cart_add")
     * @param $id
     * @param CartService $cartService
     * @return RedirectResponse
     */
    public function add($id, CartService $cartService)
    {
        $cartService->add($id);

        return $this->redirectToRoute('main');

    }

    /**
     * @Route("/panier/remove/{id}", name="cart_remove")
     */
    public function remove($id, CartService $cartService)
    {
        $cartService->remove($id);

        return $this->redirectToRoute('cart');

    }
}
