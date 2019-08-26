<?php

namespace App\Controller\Admin;

use App\Entity\Borough;
use App\Service\Paginator;
use App\Form\BoroughType;
use App\Repository\BoroughRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminBoroughController extends AbstractController
{
    /**
     * @Route("/admin/arrondissement/{page<\d+>?1}", name="admin_borough_index")
     */
    public function index(BoroughRepository $repo, $page, Paginator $paginator, Request $request, ObjectManager $manager)
    {
        $paginator  ->setEntityClass(Borough::class)
                    ->setPage($page);

        $borough = new Borough();

        $form = $this->createForm(BoroughType::class, $borough);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($borough);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'arrondissement <b>{$borough->getName()}</b> a bien été enregistré !"
            );

            return $this->redirectToRoute('admin_borough_index');
        }

        return $this->render('admin/borough/index.html.twig', [
            'paginator' => $paginator,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'éditer une billetterie dans l'admin
     *
     * @Route("/admin/arrondissement/{id}/editer", name="admin_borough_edit")
     * 
     * @param Borough $borough
     * @return Response
     */
    public function edit(Borough $borough, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(BoroughType::class, $borough);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($borough);
            $manager->flush();

            $this->addFlash(
                'success',
                "<div class='row'>
                    <div class='col'>
                        L'arrondissement '{$borough->getName()}' a bien été modifié !<br>
                    </div>
                    <div class='col text-right'>
                        <a href='../' class='btn btn-primary'>Revenir sur la liste des arrondissements</a>
                    </div>
                </div>"
            );
        }

        return $this->render('admin/borough/edit.html.twig', [
            'form' => $form->createView(),
            'borough' => $borough
        ]);
    }

    /**
     * Permet de supprimer une billetterie
     *
     * @Route("/admin/arrondissement/{id}/supprimer", name="admin_borough_delete")
     * 
     * @param Borough $borough
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Borough $borough, ObjectManager $manager){
        $manager->remove($borough);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'arrondissement <b>'{$borough->getName()}'</b> a bien été supprimé !"
        );

        return $this->redirectToRoute('admin_borough_index');
    }
}
