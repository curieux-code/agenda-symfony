<?php

namespace App\Controller\Admin;

use App\Entity\Country;
use App\Service\Paginator;
use App\Form\CountryType;
use App\Repository\CountryRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCountryController extends AbstractController
{
    /**
     * @Route("/admin/pays/{page<\d+>?1}", name="admin_country_index")
     */
    public function index(CountryRepository $repo, $page, Paginator $paginator, Request $request, ObjectManager $manager)
    {
        $paginator  ->setEntityClass(Country::class)
                    ->setPage($page);

        $country = new Country();

        $form = $this->createForm(CountryType::class, $country);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($country);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le pays <b>{$country->getName()}</b> a bien été enregistré !"
            );

            return $this->redirectToRoute('admin_country_index');
        }

        return $this->render('admin/country/index.html.twig', [
            'paginator' => $paginator,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'éditer une région dans l'admin
     *
     * @Route("/admin/pays/{id}/editer", name="admin_country_edit")
     * 
     * @param Country $country
     * @return Response
     */
    public function edit(Country $country, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(CountryType::class, $country);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($country);
            $manager->flush();

            $this->addFlash(
                'success',
                "<div class='row'>
                    <div class='col'>
                        Le pays '{$country->getName()}' a bien été modifié !<br>
                    </div>
                    <div class='col text-right'>
                        <a href='../' class='btn btn-primary'>Revenir sur la liste des pays</a>
                    </div>
                </div>"
            );
        }

        return $this->render('admin/country/edit.html.twig', [
            'form' => $form->createView(),
            'country' => $country
        ]);
    }

    /**
     * Permet de supprimer une région
     *
     * @Route("/admin/country/{id}/supprimer", name="admin_country_delete")
     * 
     * @param Country $country
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Country $country, ObjectManager $manager){
        $manager->remove($country);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le pays <b>'{$country->getName()}'</b> a bien été supprimé !"
        );

        return $this->redirectToRoute('admin_country_index');
    }
}
