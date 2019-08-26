<?php

namespace App\Controller\Admin;

use App\Entity\Ticketing;
use App\Service\Paginator;
use App\Form\TicketingType;
use App\Repository\TicketingRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminTicketingController extends AbstractController
{
    /**
     * @Route("/admin/billetterie/{page<\d+>?1}", name="admin_ticketing_index")
     */
    public function index(TicketingRepository $repo, $page, Paginator $paginator, Request $request, ObjectManager $manager)
    {
        $paginator  ->setEntityClass(Ticketing::class)
                    ->setPage($page);

        $ticketing = new Ticketing();

        $form = $this->createForm(TicketingType::class, $ticketing);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($ticketing);
            $manager->flush();

            $this->addFlash(
                'success',
                "La billetterie <strong>{$ticketing->getName()}</strong> a bien été enregistrée !"
            );

            return $this->redirectToRoute('admin_ticketing_index', [
                'slug' => $ticketing->getSlug()
            ]);
        }

        return $this->render('admin/ticketing/index.html.twig', [
            'paginator' => $paginator,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'éditer une billetterie dans l'admin
     *
     * @Route("/admin/billetterie/{id}/editer", name="admin_ticketing_edit")
     * 
     * @param Ticketing $ticketing
     * @return Response
     */
    public function edit(Ticketing $ticketing, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(TicketingType::class, $ticketing);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($ticketing);
            $manager->flush();

            $this->addFlash(
                'success',
                "<div class='row'>
                <div class='col'>
                    La billetterie '{$ticketing->getName()}' a bien été modifiée !<br>
                </div>
                <div class='col text-right'>
                    <a href='../' class='btn btn-primary'>Revenir sur la liste des billetteries</a>
                </div>
            </div>"
            );
        }

        return $this->render('admin/ticketing/edit.html.twig', [
            'form' => $form->createView(),
            'ticketing' => $ticketing
        ]);
    }

    /**
     * Permet de supprimer une billetterie
     *
     * @Route("/admin/billetterie/{id}/supprimer", name="admin_ticketing_delete")
     * 
     * @param Ticketing $ticketing
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Ticketing $ticketing, ObjectManager $manager){
        $manager->remove($ticketing);
        $manager->flush();

        $this->addFlash(
            'success',
            "La billetterie <strong>'{$ticketing->getTitle()}'</strong> a bien été supprimée !"
        );

        return $this->redirectToRoute('admin_ticketing_index');
    }
}
