<?php

namespace App\Controller\Admin;

use App\Entity\Region;
use App\Service\Paginator;
use App\Form\RegionType;
use App\Repository\RegionRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminRegionController extends AbstractController
{
    /**
     * @Route("/admin/region/{page<\d+>?1}", name="admin_region_index")
     */
    public function index(RegionRepository $repo, $page, Paginator $paginator, Request $request, ObjectManager $manager)
    {
        $paginator  ->setEntityClass(Region::class)
                    ->setPage($page);

        $region = new Region();

        $form = $this->createForm(RegionType::class, $region);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($region);
            $manager->flush();

            $this->addFlash(
                'success',
                "La région <b>{$region->getName()}</b> a bien été enregistrée !"
            );

            return $this->redirectToRoute('admin_region_index');
        }

        return $this->render('admin/region/index.html.twig', [
            'paginator' => $paginator,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'éditer une région dans l'admin
     *
     * @Route("/admin/region/{id}/editer", name="admin_region_edit")
     * 
     * @param Region $region
     * @return Response
     */
    public function edit(Region $region, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(RegionType::class, $region);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($region);
            $manager->flush();

            $this->addFlash(
                'success',
                "<div class='row'>
                <div class='col'>
                La région '{$region->getName()}' a bien été modifiée !<br>
                </div>
                <div class='col text-right'>
                    <a href='../' class='btn btn-primary'>Revenir sur la liste des régions</a>
                </div>
            </div>"
            );
        }

        return $this->render('admin/region/edit.html.twig', [
            'form' => $form->createView(),
            'region' => $region
        ]);
    }

    /**
     * Permet de supprimer une région
     *
     * @Route("/admin/region/{id}/supprimer", name="admin_region_delete")
     * 
     * @param Region $region
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Region $region, ObjectManager $manager){
        $manager->remove($region);
        $manager->flush();

        $this->addFlash(
            'success',
            "La région <b>'{$region->getName()}'</b> a bien été supprimée !"
        );

        return $this->redirectToRoute('admin_region_index');
    }
}
