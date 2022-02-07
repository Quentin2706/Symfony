<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/profil")
 * @method render(string $string, array $array)
 */
class ProfilController extends AbstractController {

    /**
     * @Route("/detail", name="profil")
     */
    public function index() :Response
    {
        $info = ['lastname' => 'Loper', 'firstname' => 'Dave', 'email' => 'daveloper@code.dom', 'birthdate' => '01/01/1970'];
        // On affiche la page d'accueil. 
        return $this->render('profil/detail.html.twig', [
            "informations" => $info,
        ]);
    }
}

