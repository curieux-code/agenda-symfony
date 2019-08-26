<?php

namespace App\Controller\Admin;

use App\Repository\PlaceRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPlaceController extends AbstractController
{
    /**
     * @Route("/admin/lieu", name="admin_place_index")
     */
    public function index(PlaceRepository $repo)
    {
        return $this->render('admin/place/index.html.twig', [
            'places' => $repo->findAll()
        ]);
    }
}
