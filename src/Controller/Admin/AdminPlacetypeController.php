<?php

namespace App\Controller\Admin;

use App\Entity\Placetype;
use App\Service\Paginator;
use App\Form\PlacetypeType;
use App\Repository\PlacetypeRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPlacetypeController extends AbstractController
{
    /**
     * @Route("/admin/type/{page<\d+>?1}", name="admin_placetype_index")
     */
    public function index(PlacetypeRepository $repo, $page, Paginator $paginator, Request $request, ObjectManager $manager)
    {
        $paginator  ->setEntityClass(Placetype::class)
                    ->setPage($page);

        $placetype = new Placetype();

        $form = $this->createForm(PlacetypeType::class, $placetype);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($placetype);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le type <strong>{$placetype->getName()}</strong> a bien été enregistré !"
            );

            return $this->redirectToRoute('admin_placetype_index');
        }

        return $this->render('admin/placetype/index.html.twig', [
            'paginator' => $paginator,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'éditer un type de lieu dans l'admin
     *
     * @Route("/admin/type/{id}/editer", name="admin_placetype_edit")
     * 
     * @param Placetype $placetype
     * @return Response
     */
    public function edit(Placetype $placetype, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(PlacetypeType::class, $placetype);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($placetype);
            $manager->flush();

            $this->addFlash(
                'success',
                "<div class='row'>
                    <div class='col'>
                    Le type <b>'{$placetype->getName()}' a bien été modifié !<br>
                    </div>
                    <div class='col text-right'>
                        <a href='../' class='btn btn-primary'>Revenir sur la liste des types de lieu</a>
                    </div>
                </div>"
            );
        }

        return $this->render('admin/placetype/edit.html.twig', [
            'form' => $form->createView(),
            'placetype' => $placetype
        ]);
    }

    /**
     * Permet de supprimer une billetterie
     *
     * @Route("/admin/billetterie/{id}/supprimer", name="admin_placetype_delete")
     * 
     * @param Placetype $placetype
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Placetype $placetype, ObjectManager $manager){
        $manager->remove($placetype);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le type <b>{$placetype->getName()}</b> a bien été supprimé !"
        );

        return $this->redirectToRoute('admin_placetype_index');
    }
}
