<?php

namespace App\Controller\Admin;

use App\Entity\Placekind;
use App\Service\Paginator;
use App\Form\PlacekindType;
use App\Repository\PlacekindRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPlacekindController extends AbstractController
{
    /**
     * @Route("/admin/type/{page<\d+>?1}", name="admin_placekind_index")
     */
    public function index(PlacekindRepository $repo, $page, Paginator $paginator, Request $request, ObjectManager $manager)
    {
        $paginator  ->setEntityClass(Placekind::class)
                    ->setPage($page);

        $placekind = new Placekind();

        $form = $this->createForm(PlacekindType::class, $placekind);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($placekind);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le type <strong>{$placekind->getName()}</strong> a bien été enregistré !"
            );

            return $this->redirectToRoute('admin_placekind_index');
        }

        return $this->render('admin/placekind/index.html.twig', [
            'paginator' => $paginator,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'éditer un type de lieu dans l'admin
     *
     * @Route("/admin/type/{id}/editer", name="admin_placekind_edit")
     * 
     * @param Placekind $placekind
     * @return Response
     */
    public function edit(Placekind $placekind, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(PlacekindType::class, $placekind);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($placekind);
            $manager->flush();

            $this->addFlash(
                'success',
                "<div class='row'>
                    <div class='col'>
                    Le type <b>'{$placekind->getName()}' a bien été modifié !<br>
                    </div>
                    <div class='col text-right'>
                        <a href='../' class='btn btn-primary'>Revenir sur la liste des types de lieu</a>
                    </div>
                </div>"
            );
        }

        return $this->render('admin/placekind/edit.html.twig', [
            'form' => $form->createView(),
            'placekind' => $placekind
        ]);
    }

    /**
     * Permet de supprimer une billetterie
     *
     * @Route("/admin/billetterie/{id}/supprimer", name="admin_placekind_delete")
     * 
     * @param Placekind $placekind
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Placekind $placekind, ObjectManager $manager){
        $manager->remove($placekind);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le type <b>{$placekind->getName()}</b> a bien été supprimé !"
        );

        return $this->redirectToRoute('admin_placekind_index');
    }
}
