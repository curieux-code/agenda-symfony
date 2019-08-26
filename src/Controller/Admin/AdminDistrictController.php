<?php

namespace App\Controller\Admin;

use App\Entity\District;
use App\Service\Paginator;
use App\Form\DistrictType;
use App\Repository\DistrictRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDistrictController extends AbstractController
{
    /**
     * @Route("/admin/quartier/{page<\d+>?1}", name="admin_district_index")
     */
    public function index(DistrictRepository $repo, $page, Paginator $paginator, Request $request, ObjectManager $manager)
    {
        $paginator  ->setEntityClass(District::class)
                    ->setPage($page);

        $district = new District();

        $form = $this->createForm(DistrictType::class, $district);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($district);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le quartier <b>{$district->getName()}</b> a bien été enregistré !"
            );

            return $this->redirectToRoute('admin_district_index');
        }

        return $this->render('admin/district/index.html.twig', [
            'paginator' => $paginator,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'éditer un quartier dans l'admin
     *
     * @Route("/admin/quartier/{id}/editer", name="admin_district_edit")
     * 
     * @param District $district
     * @return Response
     */
    public function edit(District $district, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(DistrictType::class, $district);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($district);
            $manager->flush();

            $this->addFlash(
                'success',
                "<div class='row'>
                <div class='col'>
                Le quartier '{$district->getName()}' a bien été modifié !<br>
                </div>
                <div class='col text-right'>
                    <a href='../' class='btn btn-primary'>Revenir sur la liste des quartiers</a>
                </div>
            </div>"
            );
        }

        return $this->render('admin/district/edit.html.twig', [
            'form' => $form->createView(),
            'district' => $district
        ]);
    }

    /**
     * Permet de supprimer une quartier
     *
     * @Route("/admin/quartier/{id}/supprimer", name="admin_district_delete")
     * 
     * @param District $district
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(District $district, ObjectManager $manager){
        $manager->remove($district);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le quartier <b>'{$district->getName()}'</b> a bien été supprimé !"
        );

        return $this->redirectToRoute('admin_district_index');
    }
}
