<?php

namespace App\Controller;

use App\Entity\Villes;
use App\Form\VillesType;
use App\Repository\VillesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/villes")
 */
class VillesController extends AbstractController
{
    /**
     * @Route("/", name="villes_index", methods={"GET"})
     */
    public function index(VillesRepository $villesRepository): Response
    {
        return $this->render('villes/index.html.twig', [
            'villes' => $villesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="villes_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ville = new Villes();
        $form = $this->createForm(VillesType::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ville);
            $entityManager->flush();

            return $this->redirectToRoute('villes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('villes/new.html.twig', [
            'ville' => $ville,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="villes_show", methods={"GET"})
     */
    public function show(Villes $ville): Response
    {
        return $this->render('villes/show.html.twig', [
            'ville' => $ville,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="villes_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Villes $ville, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VillesType::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('villes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('villes/edit.html.twig', [
            'ville' => $ville,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="villes_delete", methods={"POST"})
     */
    public function delete(Request $request, Villes $ville, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ville->getId(), $request->request->get('_token'))) {
            $entityManager->remove($ville);
            $entityManager->flush();
        }

        return $this->redirectToRoute('villes_index', [], Response::HTTP_SEE_OTHER);
    }
}
