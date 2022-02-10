<?php

namespace App\Controller;

use App\Entity\Products;
use App\Form\ProductsType;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @Route("/products")
 */
class ProductsController extends AbstractController
{
    /**
     * @Route("/", name="products_index", methods={"GET"})
     */
    public function index(ProductsRepository $productsRepository): Response
    {
        return $this->render('products/index.html.twig', [
            'products' => $productsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="products_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $product = new Products();
        $form = $this->createForm(ProductsType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setDiscontinued(1);
            $pictureFile = $form['Picture2']->getData();
                if ($pictureFile) {
                    $newPicture = uniqid() . '.' . $pictureFile->guessExtension();
                    $product->setPicture($newPicture);
                    try {
                        $pictureFile->move(
                            $this->getParameter('photo_directory'),
                            $newPicture
                        );
                    } catch (FileException $e) {
                        //throw $th;
                    }
                }
            $entityManager->persist($product);
            $entityManager->flush();
            $this->addFlash('success', 'Produit ajouté avec succès !!');
            return $this->redirectToRoute('products_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('products/new.html.twig', [
            'product' => $product,
            'form' => $form,
            'button_label' => "Ajouter",
        ]);
    }

    /**
     * @Route("/{id}", name="products_show", methods={"GET"})
     */
    public function show(Products $product): Response
    {
        return $this->render('products/show.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="products_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Products $product, EntityManagerInterface $entityManager): Response
    {
        // récupération de l'id du produit
        $form = $this->createForm(ProductsType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // récupération de la saisi sur l'upload
            $pictureFile = $form['Picture2']->getData();
            if ($pictureFile) {
                $newPicture = uniqid($product->getId()) . '.' . $pictureFile->guessExtension();
                $product->setPicture($newPicture);
                try {
                    $pictureFile->move(
                        $this->getParameter('photo_directory'),
                        $newPicture
                    );
                } catch (FileException $e) {
                    //throw $th;
                }
            }
            $entityManager->flush();
            return $this->redirectToRoute('products_index');
        }
        return $this->render('products/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="products_delete", methods={"POST"})
     */
    public function delete(Request $request, Products $product, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->request->get('_token'))) {
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('products_index', [], Response::HTTP_SEE_OTHER);
    }
}
