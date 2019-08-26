<?php

namespace App\Controller\Admin;

use App\Entity\City;
use App\Service\Paginator;
use App\Form\CityType;
use App\Repository\CityRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCityController extends AbstractController
{
    /**
     * @Route("/admin/ville/{page<\d+>?1}", name="admin_city_index")
     */
    public function index(CityRepository $repo, $page, Paginator $paginator, Request $request, ObjectManager $manager)
    {
        $paginator  ->setEntityClass(City::class)
                    ->setPage($page);

        $city = new City();

        $form = $this->createForm(CityType::class, $city);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($city);
            $manager->flush();

            $this->addFlash(
                'success',
                "La ville de <b>{$city->getName()}</b> a bien été enregistrée !"
            );

            return $this->redirectToRoute('admin_city_index');
        }

        return $this->render('admin/city/index.html.twig', [
            'paginator' => $paginator,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'éditer une billetterie dans l'admin
     *
     * @Route("/admin/ville/{id}/editer", name="admin_city_edit")
     * 
     * @param City $city
     * @return Response
     */
    public function edit(City $city, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(CityType::class, $city);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($city);
            $manager->flush();

            $this->addFlash(
                'success',
                "<div class='row'>
                    <div class='col'>
                        La ville de '{$city->getName()}' a bien été modifiée !<br>
                    </div>
                    <div class='col text-right'>
                        <a href='../' class='btn btn-primary'>Revenir sur la liste des villes</a>
                    </div>
                </div>"
            );
        }

        return $this->render('admin/city/edit.html.twig', [
            'form' => $form->createView(),
            'city' => $city
        ]);
    }

    /**
     * Permet de supprimer une billetterie
     *
     * @Route("/admin/ville/{id}/supprimer", name="admin_city_delete")
     * 
     * @param City $city
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(City $city, ObjectManager $manager){
        $manager->remove($city);
        $manager->flush();

        $this->addFlash(
            'success',
            "La ville de <b>'{$city->getName()}'</b> a bien été supprimée !"
        );

        return $this->redirectToRoute('admin_city_index');
    }
}
