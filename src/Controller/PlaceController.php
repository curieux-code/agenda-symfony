<?php

namespace App\Controller;

use App\Entity\Place;
use App\Entity\Placekind;
use App\Form\PlaceType;
use App\Repository\PlaceRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlaceController extends AbstractController
{
    /**
     * @Route("/annuaire", name="place_index")
     */
    public function index(PlaceRepository $repo)
    {
        $places = $repo->findAll();

        $repoType = $this->getDoctrine()->getRepository(Placekind::class);
        $placekinds = $repoType->findAll();

        return $this->render('place/index.html.twig', [
            'places' => $places,
            'placekinds' => $placekinds
        ]);
    }


    /**
     * Permet d'afficher les évènements d'un lieu et les infos du lieu
     * 
     * @Route("/annuaire/{slug}", name="place_show")
     * 
     * @return Response
     */
    public function show(Place $place){

        return $this->render('place/show.html.twig', [
            'place' => $place
        ]);
    }



    /**
     * Créer un lieu
     * 
     * @Route("/ajouter-un-lieu", name="place_create")
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager){
        $place = new Place();

        $form = $this->createForm(PlaceType::class, $place);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($place);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong>{$place->getTitle()}</strong> a bien été enregistré !"
            );

            return $this->redirectToRoute('place_show', [
                'slug' => $place->getSlug()
            ]);
        }

        return $this->render('place/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


}
