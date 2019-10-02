<?php

namespace App\Controller;

use App\Entity\Festival;
use App\Form\FestivalType;
use App\Repository\RubricRepository;
use App\Repository\CategoryRepository;
use App\Repository\FestivalRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FestivalController extends AbstractController
{
    /**
     * @Route("/festival", name="festival_index")
     */
    public function index(FestivalRepository $repo, RubricRepository $repoRubric, CategoryRepository $repoCategory)
    {
        $festivals = $repo->findAll();
        $rubrics = $repoRubric->findAll();
        $categorys = $repoCategory->findAll();

        return $this->render('festival/index.html.twig', [
            'festivals' => $festivals,
            'rubrics' => $rubrics,
            'categorys' => $categorys
        ]);
    }

    /**
     * Permet d'afficher un seul festival
     * 
     * @Route("/festival/{slug}", name="festival_show")
     * 
     * @return Response
     */
    public function show(Festival $festival){

        return $this->render('festival/show.html.twig', [
            'festival' => $festival,
            'directory' => ''
        ]);
    }

    
    /**
     * Créer un festival
     * 
     * @Route("/ajouter-un-festival", name="festival_create")
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager){
        $festival = new Festival();

        $form = $this->createForm(FestivalType::class, $festival);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($festival);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le festival <strong>{$festival->getTitle()}</strong> a bien été enregistré !"
            );

            return $this->redirectToRoute('festival_show', [
                'slug' => $festival->getSlug()
            ]);
        }

        return $this->render('festival/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


}
