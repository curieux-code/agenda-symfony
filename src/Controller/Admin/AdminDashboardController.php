<?php

namespace App\Controller\Admin;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(ObjectManager $manager)
    {
        $users = $manager->createQuery('SELECT COUNT(u) FROM App\Entity\User u')->getSingleScalarResult();
        $events = $manager->createQuery('SELECT COUNT(e) FROM App\Entity\Event e')->getSingleScalarResult();
        $places = $manager->createQuery('SELECT COUNT(p) FROM App\Entity\Place p')->getSingleScalarResult();
        $comments = $manager->createQuery('SELECT COUNT(c) FROM App\Entity\Comment c')->getSingleScalarResult();

        return $this->render('admin/dashboard/index.html.twig',[
            'stats' => compact('users', 'events', 'places', 'comments')
            /*
            'stats' => [
                'users' => $users,
                'events' => $events,
                'places' => $places,
                'comments' => $comments
            ]
            */
            
        ]);
    }
}
