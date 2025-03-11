<?php

namespace App\Controller;

use PDO;
use App\Entity\Product;
use App\Entity\Category;
use App\Form\ProductFormType;
use App\Form\CategoryFormType;
use Doctrine\ORM\EntityManager;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

final class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function admin(): Response
    {
        return $this->render('admin/index.html.twig', [
        ]);
    }

    #[Route('/admin/products', name: 'app_admin_products')]
    #[Route('/admin/products/update/{id}', name: 'app_admin_products_update')]
    public function adminProducts(?Product $product, Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger, ProductRepository $repoProduct): Response
    {

        // ?Product $product : le ? veut dire que par défault $produit a une valeur null

        // dump($product);
        if(!$product)
            $product = new Product;

        $form = $this->createForm(ProductFormType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pictureFile = $form->get('picture')->getData();
            // dump($pictureFile);

            if ($pictureFile) {
                // retourne le nom du fichier d'origine (sans l'extension)

                $originalFileName = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // dump($originalFileName);

                // slug() sécurise le nom du fichier (suppression espace etc...)
                $safeFileName = $slugger->slug($originalFileName);
                // dump($safeFileName);

                // on renome l'image 
                //                    p2-4457842511.png
                $newFileName = $safeFileName . '-' . uniqid() . '.' . $pictureFile->guessExtension();
                // dump($newFileName);
                // dump($this->getParameter('image_directory'));
                $currentPath = $this->getParameter('image_directory');

                try {
                    $pictureFile->move($currentPath, $newFileName);
                } catch (FileException $e) {
                    dump($e);
                }
                $product->setPicture($newFileName);
                dump($product);
            }
            $product->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash('success', "L'article a été enregistré.");

            return $this->redirectToRoute('app_admin_products');
        }

        /*
            Exo :
            1. sélectionner tout les produits enregistrés dans la BDD (répository)
            2. transmettre les données délectionnées au template
            3. afficher les données sous forme de tableau HTML dans le template 'admin/product.html.twig' (boucle {% for in %})
            4. prévoir pour chaque produit, deux liens modification / suppression 
        */

        // $repoProduct : objet issu de la class ProductRepository
        $repoProduct = $entityManager->getRepository(Product::class);
        $dbProduct = $repoProduct->findAll();
        // dump($dbProduct);

        return $this->render('admin/products.html.twig', [
            'productForm' => $form,
            'dbProduct' => $dbProduct,
            'pictureFile' => $product->getPicture()
        ]);
    }

    #[Route('/admin/orders', name: 'app_admin_orders')]
    public function adminOrders(): Response
    {
        return $this->render('admin/orders.html.twig', [
        ]);
    }

    #[Route('/admin/users', name: 'app_admin_users')]
    public function adminUsers(): Response
    {
        return $this->render('admin/users.html.twig', [
        ]);
    }

    #[Route('/admin/category', name: 'app_admin_category')]
    public function adminCategory(Request $request, EntityManagerInterface $entityManager, CategoryRepository $repoCategory): Response
    {
        $category = new Category;

        $form = $this->createForm(CategoryFormType::class, $category);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $category->setCreatedAt(new \DateTimeImmutable());

            // $connect_db->prepare("INSERT INTO category VALUES (:title)")
            // $connect_db->bindValue(':title', $category->getTitle(), PDO::PARAM_STR)
            $entityManager->persist($category);

            // $stmt->execute
            $entityManager->flush();

            // Message utilisateur stockés en session
            $this->addFlash('success', 'La categorie a été enregistrée.');

            return $this->redirectToRoute('app_admin_category');
        }

        /*
            Une classe Repository contient des méthodes permettant uniquement d'executer des reuêtes de sélections (SELECT) EN BDD (find($id), findAll(), findBy(), findOneBy())
        */

        $dbCategory = $repoCategory->findAll();
        // dump($dbCategory);

        return $this->render('admin/category.html.twig', [
            'categoryForm' => $form,
            'dbCategory' => $dbCategory
        ]);
    }

    #[Route('/admin/category/update/{id}', name: 'app_admin_category_update')]
    public function adminCategoryUpdate($id, Category $category, Request $request, EntityManagerInterface $entityManager, CategoryRepository $repoCategory): response
    {
        // dump($category);

        // SELECT * FROM category WHERE id = $id;
        // + fetch(PDO::FETCH_ASSOC)
        $category = $repoCategory->find($id);
        // dump($id);
        // dump($category);

        $form = $this->createForm(CategoryFormType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // UPDATE category SET title = $category->geTitle(), description = $category->getDescription WHERE id = $id
            $entityManager->persist($category);
            $entityManager->flush();

            // dump($category->getTitle());
            $categoryTitle = $category->getTitle();

            $this->addFlash('success', "La catégorie <strong class='text-white'>$categoryTitle</strong> a été modifier");

            return $this->redirectToRoute('app_admin_category');
        }

        $dbCategory = $repoCategory->findAll();

        return $this->render('admin/category.html.twig', [
            'categoryForm' => $form,
            'dbCategory' => $dbCategory
        ]);
    }

    #[Route('/admin/category/remove/{id}', name: 'app_admin_category_remove')]
    public function adminCategoryRemove($id, EntityManagerInterface $entityManager, CategoryRepository $repoCategory): response
    {
        $category = $repoCategory->find($id);
        dump($category);

        // DELETE FROM category WHERE id = $id
        $entityManager->remove($category);
        $entityManager->flush();

        $this->addFlash('success', "La catégorie a été supprimée.");

        return $this->redirectToRoute('app_admin_category');
    }
}