<?php

namespace App\Controller\Admin;

use App\Entity\Rubric;
use App\Service\Paginator;
use App\Form\RubricType;
use App\Repository\RubricRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminRubricController extends AbstractController
{
    /**
     * @Route("/admin/rubrique/{page<\d+>?1}", name="admin_rubric_index")
     */
    public function index(RubricRepository $repo, $page, Paginator $paginator, Request $request, ObjectManager $manager)
    {
        $paginator  ->setEntityClass(Rubric::class)
                    ->setPage($page);

        $rubric = new Rubric();

        $form = $this->createForm(RubricType::class, $rubric);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($rubric);
            $manager->flush();

            $this->addFlash(
                'success',
                "La rubrique <b>{$rubric->getName()}</b> a bien été enregistrée !"
            );

            return $this->redirectToRoute('admin_rubric_index');
        }

        return $this->render('admin/rubric/index.html.twig', [
            'paginator' => $paginator,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'éditer une rubrique dans l'admin
     *
     * @Route("/admin/rubrique/{id}/editer", name="admin_rubric_edit")
     * 
     * @param Rubric $rubric
     * @return Response
     */
    public function edit(Rubric $rubric, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(RubricType::class, $rubric);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($rubric);
            $manager->flush();

            $this->addFlash(
                'success',
                "<div class='row'>
                <div class='col'>
                La rubrique '{$rubric->getName()}' a bien été modifiée !<br>
                </div>
                <div class='col text-right'>
                    <a href='../' class='btn btn-primary'>Revenir sur la liste des rubriques</a>
                </div>
            </div>"
            );
        }

        return $this->render('admin/rubric/edit.html.twig', [
            'form' => $form->createView(),
            'rubric' => $rubric
        ]);
    }

    /**
     * Permet de supprimer une rubrique
     *
     * @Route("/admin/rubrique/{id}/supprimer", name="admin_rubric_delete")
     * 
     * @param Rubric $rubric
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Rubric $rubric, ObjectManager $manager){
        $manager->remove($rubric);
        $manager->flush();

        $this->addFlash(
            'success',
            "La rubrique <b>'{$rubric->getName()}'</b> a bien été supprimée !"
        );

        return $this->redirectToRoute('admin_rubric_index');
    }
}
