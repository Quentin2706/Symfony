<?php

namespace App\Controller;

use App\Entity\Products;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TestController extends AbstractController
{

    /**
     * @Route("/test", name="test")
     * 
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Products::class);
        
        $obj = $repo->findAll();

        return $this->render('test/index.html.twig', [
            'products' => $obj
            ]);
    }
}