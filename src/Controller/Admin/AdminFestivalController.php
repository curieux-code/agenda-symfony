<?php

namespace App\Controller\Admin;

use App\Entity\Festival;
use App\Service\Paginator;
use App\Form\FestivalType;
use App\Repository\FestivalRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminFestivalController extends AbstractController
{
    /**
     * @Route("/admin/festival/{page<\d+>?1}", name="admin_festival_index")
     */
    public function index(FestivalRepository $repo, $page, Paginator $paginator, Request $request, ObjectManager $manager)
    {
        $paginator  ->setEntityClass(Festival::class)
                    ->setPage($page);

        $festival = new Festival();

        $form = $this->createForm(FestivalType::class, $festival);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($festival);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le festival <b>{$festival->getTitle()}</b> a bien été enregistré !"
            );

            return $this->redirectToRoute('admin_festival_index');
        }

        return $this->render('admin/festival/index.html.twig', [
            'paginator' => $paginator,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'éditer un festival dans l'admin
     *
     * @Route("/admin/festival/{id}/editer", name="admin_festival_edit")
     * 
     * @param Festival $festival
     * @return Response
     */
    public function edit(Festival $festival, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(FestivalType::class, $festival);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($festival);
            $manager->flush();

            $this->addFlash(
                'success',
                "<div class='row'>
                <div class='col'>
                Le festival '{$festival->getTitle()}' a bien été modifié !<br>
                </div>
                <div class='col text-right'>
                    <a href='../' class='btn btn-primary'>Revenir sur la liste des festivals</a>
                </div>
            </div>"
            );
        }

        return $this->render('admin/festival/edit.html.twig', [
            'form' => $form->createView(),
            'festival' => $festival
        ]);
    }

    /**
     * Permet de supprimer une festival
     *
     * @Route("/admin/festival/{id}/supprimer", name="admin_festival_delete")
     * 
     * @param Festival $festival
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Festival $festival, ObjectManager $manager){
        $manager->remove($festival);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le festival <b>'{$festival->getTitle()}'</b> a bien été supprimé !"
        );

        return $this->redirectToRoute('admin_festival_index');
    }
}
