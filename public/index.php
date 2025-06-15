<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;

require_once __DIR__ . '/../vendor/autoload.php';

$routes = require __DIR__ . '/../config/routes.php';

$context = new RequestContext();
$request = Request::createFromGlobals();
$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);
$session = new Session();
$session->start();

try {
    $parameters = $matcher->match($request->getPathInfo());
    extract($parameters); // $action aus dem Routing
    $response = null;

    if ($action === 'add') {
        $id = $request->query->getInt('id');
        $name = $request->query->get('name');
        $price = $request->query->getFloat('price');
        $quantity = $request->query->getInt('quantity', 1);

        $cart = $session->get('cart', []);
        $cart[$id] = [
            'name' => $name,
            'price' => $price,
            'quantity' => isset($cart[$id]) ? $cart[$id]['quantity'] + $quantity : $quantity
        ];
        $session->set('cart', $cart);

        $response = new Response("Produkt $name wurde hinzugefügt.");
    }

    elseif ($action === 'remove') {
        $id = $request->query->getInt('id');
        $cart = $session->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            $session->set('cart', $cart);
            $response = new Response("Produkt mit ID $id wurde entfernt.");
        } else {
            $response = new Response("Produkt nicht gefunden.", 404);
        }
    }

    elseif ($action === 'view') {
        $cart = $session->get('cart', []);
        $total = 0;
        $output = "<h1>Warenkorb</h1><ul>";
        foreach ($cart as $id => $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
            $output .= sprintf(
                "<li>%s (%d × %.2f €) = %.2f €</li>",
                htmlspecialchars($item['name']),
                $item['quantity'],
                $item['price'],
                $subtotal
            );
        }
        $output .= "</ul><strong>Gesamt: " . number_format($total, 2) . " €</strong>";
        $response = new Response($output);
    }

    else {
        $response = new Response("Unbekannte Aktion.", 400);
    }

} catch (Exception $e) {
    $response = new Response("Fehler: " . $e->getMessage(), 500);
}

$response->send();
