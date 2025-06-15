<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CartManager;
use Twig\Environment;

class CartController
{
    /**
     * Konstruktor für den Warenkorb-Controller
     *
     * @param CartManager $cartManager
     * @param Environment $twig
     */
    public function __construct(
        private CartManager $cartManager,
        private Environment $twig
    ) {}

    /**
     * Fügt ein Produkt zum Warenkorb hinzu.
     *
     * @param Request $request
     * @return Response
     */
    #[Route('/cart/add', name: 'cart_add')]
    public function add(Request $request): Response
    {
        $id = $request->query->getInt('id');
        $name = $request->query->get('name');
        $price = $request->query->getFloat('price');
        $quantity = $request->query->getInt('quantity', 1);

        $this->cartManager->add($id, $name, $price, $quantity);
        return new Response("Produkt $name wurde hinzugefügt.");
    }

    /**
     * Entfernt ein Produkt aus dem Warenkorb.
     *
     * @param Request $request
     * @return Response
     */
    #[Route('/cart/remove', name: 'cart_remove')]
    public function remove(Request $request): Response
    {
        $id = $request->query->getInt('id');
        $this->cartManager->remove($id);
        return new Response("Produkt mit ID $id wurde entfernt.");
    }

    /**
     * Zeigt den Inhalt des Warenkorbs an.
     *
     * @return Response
     */
    #[Route('/cart/view', name: 'cart_view')]
    public function view(): Response
    {
        $cart = $this->cartManager->getCart();
        return new Response($this->twig->render('cart/view.html.twig', [
            'items' => $cart->getItems(),
            'total' => $this->cartManager->getDiscountedTotal($cart->getTotal(), 'friends'),
        ]));
    }
}
