<?php

namespace App\Controller;

use App\Entity\Placetype;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlacetypeController extends AbstractController
{
    /**
     * @Route("/annuaire/type/{slug}", name="search_by_placetype")
     */
    public function index(Placetype $placetype, $slug)
    {
        $repoType = $this->getDoctrine()->getRepository(Placetype::class);
        $placetypes = $repoType->findAll();

        return $this->render('placetype/index.html.twig', [
            'placetype' => $placetype,
            'placetypes' => $placetypes
        ]);
    }
}
