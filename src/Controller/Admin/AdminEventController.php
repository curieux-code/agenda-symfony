<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use App\Form\EventType;
use App\Service\Paginator;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminEventController extends AbstractController
{
    /**
     * @Route("/admin/evenement/{page<\d+>?1}", name="admin_event_index")
     */
    public function index(EventRepository $repo, $page, Paginator $paginator)
    {
        //$test = $paginator->getInformation();
        //dump($test);

        $paginator->setEntityClass(Event::class)
                  //->setLimit(100)
                  //->setRoute('admin_event_index')
                  ->setPage($page);
        
        //$limit = 10;
        //$start = $page * $limit - $limit;
        //$total = count($repo->findAll());
        //$pages = ceil($total / $limit);

        return $this->render('admin/event/index.html.twig', [
            'paginator' => $paginator
            /*
            'events' => $paginator->getData(),
            'pages' => $paginator->getPages(),
            'page' => $page
            */
        ]);
    }

    /**
     * Permet d'éditer un évènement dans l'admin
     *
     * @Route("/admin/evenement/{id}/edit", name="admin_event_edit")
     * 
     * @param Event $event
     * @return Response
     */
    public function edit(Event $event, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            /*
            foreach($event->getImages() as $image){
                $image->setEvent($event);
                $manager->persist($image);
            }
            */
            // inutile car Injection dépendance
            //$manager = $this->getDoctrine()->getManager();

            $manager->persist($event);
            $manager->flush();

            $this->addFlash(
                'success',
                "<div class='row'>
                    <div class='col'>
                    L'évènement '{$event->getTitle()}' a bien été modifié !<br>
                    </div>
                    <div class='col text-right'>
                        <a href='../' class='btn btn-primary'>Revenir sur la liste des évènements</a>
                    </div>
                </div>"
            );
        }

        return $this->render('admin/event/edit.html.twig', [
            'form' => $form->createView(),
            'event' => $event
        ]);
    }

    /**
     * Permet de supprimer un évènement
     *
     * @Route("/admin/evenement/{id}/delete", name="admin_event_delete")
     * 
     * @param Event $event
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Event $event, ObjectManager $manager){
        $manager->remove($event);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'annonce <strong>'{$event->getTitle()}'</strong> a bien été supprimé !"
        );

        return $this->redirectToRoute('admin_event_index');
    }
}
