<?php

namespace App\Controller;

use App\Entity\Placekind;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlacekindController extends AbstractController
{
    /**
     * @Route("/annuaire/type/{slug}", name="search_by_placekind")
     */
    public function index(Placekind $placekind, $slug)
    {
        $repoType = $this->getDoctrine()->getRepository(Placekind::class);
        $placekinds = $repoType->findAll();

        return $this->render('placekind/index.html.twig', [
            'placekind' => $placekind,
            'placekinds' => $placekinds
        ]);
    }
}
