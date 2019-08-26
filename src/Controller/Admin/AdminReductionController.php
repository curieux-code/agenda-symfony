<?php

namespace App\Controller\Admin;

use App\Entity\Reduction;
use App\Service\Paginator;
use App\Form\ReductionType;
use App\Repository\ReductionRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminReductionController extends AbstractController
{
    /**
     * Affiche la liste et ajouter une réduction
     * 
     * @Route("/admin/reduction/{page<\d+>?1}", name="admin_reduction_index")
     */
    public function index(ReductionRepository $repo, $page, Paginator $paginator, Request $request, ObjectManager $manager)
    {
        $paginator  ->setEntityClass(Reduction::class)
                    ->setPage($page);

        $reduction = new Reduction();

        $form = $this->createForm(ReductionType::class, $reduction);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($reduction);
            $manager->flush();

            $this->addFlash(
                'success',
                "La réduction <strong>{$reduction->getTitle()}</strong> a bien été enregistrée !"
            );

            return $this->redirectToRoute('admin_reduction_index', [
                'slug' => $reduction->getSlug()
            ]);
        }

        return $this->render('admin/reduction/index.html.twig', [
            'paginator' => $paginator,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'éditer une réduction dans l'admin
     *
     * @Route("/admin/reduction/{id}/editer", name="admin_reduction_edit")
     * 
     * @param Reduction $reduction
     * @return Response
     */
    public function edit(Reduction $reduction, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(ReductionType::class, $reduction);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($reduction);
            $manager->flush();

            $this->addFlash(
                'success',
                "<div class='row'>
                    <div class='col'>
                        La réduction '{$reduction->getTitle()}' a bien été modifiée !<br>
                    </div>
                    <div class='col text-right'>
                        <a href='../' class='btn btn-primary'>Revenir sur la liste des réductions</a>
                    </div>
                </div>"
            );
        }

        return $this->render('admin/reduction/edit.html.twig', [
            'form' => $form->createView(),
            'reduction' => $reduction
        ]);
    }

    /**
     * Permet de supprimer un reduction
     *
     * @Route("/admin/reduction/{id}/supprimer", name="admin_reduction_delete")
     * 
     * @param Reduction $reduction
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Reduction $reduction, ObjectManager $manager){
        $manager->remove($reduction);
        $manager->flush();

        $this->addFlash(
            'success',
            "La réduction <strong>'{$reduction->getTitle()}'</strong> a bien été supprimée !"
        );

        return $this->redirectToRoute('admin_reduction_index');
    }
}
