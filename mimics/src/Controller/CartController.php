<?php

namespace App\Controller;

use App\Entity\OrderDetails;
use App\Entity\Orders;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

final class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function cart(SessionInterface $session, ProductRepository $repoProduct): Response
    {
        // On récupère le panier dans la session
        $cart = $session->get('cart');
        dump($cart);

        // On initialise les données
        $dataCart = [];
        $total = 0;

        // On boucle la session
        // $id stock receptionne pour chaque tour de boucle 1 id d'un produit 
        // $quantity receptionne pour chaque tour de boucle une quantité saisi du produit
        if (!empty($cart)) {
            foreach ($cart as $id => $quantity) {
                // On selectionne en BDD les informations des produits
                $product = $repoProduct->find($id);
                dump($product);

                // On ajoute dans le tableau ARRAY les données
                $dataCart[] = [
                    "product" => $product, // on envoi l'objet Entity Product directement dans l'ARRAY
                    "quantity" => $quantity
                ];

                // Calcul du montant total de la commande
                $total += $product->getPrice() * $quantity;
            }
        }

        // dump($dataCart);
        // dump($total);

        return $this->render('cart/index.html.twig', [
            'dataCart' => $dataCart,
            'total' => $total
        ]);
    }

    #[Route('/cart/add/{id}', name: 'app_cart_add')]
    public function cartAdd(Request $request, Product $product, SessionInterface $session)
    {
        // Création du panier dans la session
        $cart = $session->get("cart", []);
        // On stock l'id du produit à ajouter dans le panier dans une variable
        $id = $product->getId(); // id : 15
        // On stock la quantité saisie dans le formulaire dans une variable
        //                      $_POST['quantity']
        $quantity = $request->request->get("quantity");

        // dump($id);
        // dump($quantity);

        //         $cart[1]
        if (isset($cart[$id])) {
            // dump('if produit existe dans panier');
            //                 1        3
            $cart[$id] = $cart[$id] + $quantity;
        } else {
            // dump('else produit inexistant dans panier');
            //              3
            $cart[$id] = $quantity;
        }

        // On sauvegarde la session
        $session->set("cart", $cart);

        // dump($cart);

        /*
            [
                $idPorduit => quantity
                    10          3
                    4           9      
            ]

        */

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/remove/{id}', name: 'app_cart_remove')]
    public function cartRemove(Product $product, SessionInterface $session)
    {
        $cart = $session->get('cart');
        $id = $product->getId();

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        $session->set("cart", $cart);

        $this->addFlash('success', "L'article a été supprimé.");

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/delete', name: 'app_cart_delete')]
    public function cartDeleteAll(SessionInterface $session)
    {
        $session->remove('cart');

        $this->addFlash('success', "Le panier a été vidé.");

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/payment', name: 'app_cart_payment')]
    public function cartPayment(SessionInterface $session, ProductRepository $productRepository, EntityManagerInterface $entityManager)
    {
        $cart = $session->get('cart');
        $total = 0;
        // dump($cart);

        foreach ($cart as $id => $quantity) {
            $product = $productRepository->find($id);
            $stockDb = $product->getStock();
            // dump($stockDb);

            // Si le stock en BDD est inférieur à la quantité commandée
            if ($stockDb < $quantity) {
                // Si le stock est supérieur à 0 mais inférieur à la quantité demandée
                if ($stockDb > 0) {
                    // on entre dans la condition si le stock est insufissant par rapport à la quantité demandée
                    dump("article " . $product->getTitle() . " stock insuffisant.");
                    dump("stock restant : " . $stockDb);
                    dump("quantité commandée : " . $quantity);

                    $this->addFlash("warning", "La quantité de l'article <strong>" . $product->getTitle() . "</strong> a été reduite car notre stock est insuffisant.");

                    $cart[$id] = $stockDb;
                } else {
                    // Sinon le stock est à 0, alors on supprime le produit de la session
                    dump("article " . $product->getTitle() . " rutpure de stock.");
                    dump("stock restant : " . $stockDb);
                    dump("quantité commandée : " . $quantity);

                    $this->addFlash("danger", "L'article <strong>" . $product->getTitle() . "</strong> a été retirer du panier car nous sommes en rupture de stock.");

                    // On supprime l'id et la quantité du produit dans la session
                    unset($cart[$id]);
                }
                $error = true;

                $session->set("cart", $cart);
            }
            $total += $product->getPrice() * $quantity;
        }

        // requete INSERT
        if (!isset($error)) {
            // Insertion dans la tabel SQL orders
            $order = new Orders;
            $order->setUser($this->getUser());
            // MINICS-13032025-124578
            $orderNumber = "MINICS-" . date('dmY') . '-' . uniqid();
            $order->setOrderNumber($orderNumber);
            $order->setRising($total);
            $order->setCreatedAt(new \DateTimeImmutable());
            $order->setState('En cours de traitement');

            $entityManager->persist($order);
            $entityManager->flush();

            // Insertion dans la table order_details
            foreach ($cart as $id => $quantity) {
                $orderDetails = new OrderDetails;

                $product = $productRepository->find($id);
                $orderDetails->setOrders($order);
                $orderDetails->setProduct($product);
                $orderDetails->setQuantity($quantity);
                $orderDetails->setPrice($product->getPrice());

                // On déprécie les stocks
                $product->setStock($product->getStock() - $quantity);

                $entityManager->persist($product);
                $entityManager->persist($orderDetails);
                $entityManager->flush();
            }

            $this->addFlash('success', "Le paiement a été effectué. Numéro de commande <strong>$orderNumber</strong>");

            $session->remove('cart');
        }

        return $this->redirectToRoute('app_cart');
    }
}
