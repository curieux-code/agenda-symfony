<?php

namespace App\Controller\Admin;

use App\Entity\Videostore;
use App\Service\Paginator;
use App\Form\VideostoreType;
use App\Repository\VideostoreRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminVideostoreController extends AbstractController
{
    /**
     * @Route("/admin/videotheque/{page<\d+>?1}", name="admin_videostore_index")
     */
    public function index(VideostoreRepository $repo, $page, Paginator $paginator, Request $request, ObjectManager $manager)
    {
        $paginator  ->setEntityClass(Videostore::class)
                    ->setPage($page);

        $videostore = new Videostore();

        $form = $this->createForm(VideostoreType::class, $videostore);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($videostore);
            $manager->flush();

            $this->addFlash(
                'success',
                "La vidéothèque <strong>{$videostore->getName()}</strong> a bien été enregistrée !"
            );

            return $this->redirectToRoute('admin_videostore_index');
        }

        return $this->render('admin/videostore/index.html.twig', [
            'paginator' => $paginator,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'éditer une billetterie dans l'admin
     *
     * @Route("/admin/videotheque/{id}/editer", name="admin_videostore_edit")
     * 
     * @param Videostore $videostore
     * @return Response
     */
    public function edit(Videostore $videostore, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(VideostoreType::class, $videostore);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($videostore);
            $manager->flush();

            $this->addFlash(
                'success',
                "<div class='row'>
                    <div class='col'>
                        La vidéothèque '{$videostore->getName()}' a bien été modifiée !<br>
                    </div>
                    <div class='col text-right'>
                        <a href='../' class='btn btn-primary'>Revenir sur la liste des vidéothèques</a>
                    </div>
                </div>"
            );
        }

        return $this->render('admin/videostore/edit.html.twig', [
            'form' => $form->createView(),
            'videostore' => $videostore
        ]);
    }

    /**
     * Permet de supprimer une billetterie
     *
     * @Route("/admin/billetterie/{id}/supprimer", name="admin_videostore_delete")
     * 
     * @param Videostore $videostore
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Videostore $videostore, ObjectManager $manager){
        $manager->remove($videostore);
        $manager->flush();

        $this->addFlash(
            'success',
            "La vidéothèque <strong>'{$videostore->getTitle()}'</strong> a bien été supprimée !"
        );

        return $this->redirectToRoute('admin_videostore_index');
    }
}
