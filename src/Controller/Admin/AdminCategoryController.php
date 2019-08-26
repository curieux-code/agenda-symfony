<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Service\Paginator;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCategoryController extends AbstractController
{
    /**
     * @Route("/admin/category/{page<\d+>?1}", name="admin_category_index")
     */
    public function index(CategoryRepository $repo, $page, Paginator $paginator, Request $request, ObjectManager $manager)
    {
        $paginator  ->setEntityClass(Category::class)
                    ->setPage($page);

        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($category);
            $manager->flush();

            $this->addFlash(
                'success',
                "La catégorie <b>{$category->getName()}</b> a bien été enregistrée !"
            );

            return $this->redirectToRoute('admin_category_index');
        }

        return $this->render('admin/category/index.html.twig', [
            'paginator' => $paginator,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'éditer une catégorie dans l'admin
     *
     * @Route("/admin/category/{id}/editer", name="admin_category_edit")
     * 
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($category);
            $manager->flush();

            $this->addFlash(
                'success',
                "<div class='row'>
                <div class='col'>
                La catégorie '{$category->getName()}' a bien été modifiée !<br>
                </div>
                <div class='col text-right'>
                    <a href='../' class='btn btn-primary'>Revenir sur la liste des catégories</a>
                </div>
            </div>"
            );
        }

        return $this->render('admin/category/edit.html.twig', [
            'form' => $form->createView(),
            'category' => $category
        ]);
    }

    /**
     * Permet de supprimer une catégorie
     *
     * @Route("/admin/category/{id}/supprimer", name="admin_category_delete")
     * 
     * @param Category $category
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Category $category, ObjectManager $manager){
        $manager->remove($category);
        $manager->flush();

        $this->addFlash(
            'success',
            "La catégorie <b>'{$category->getName()}'</b> a bien été supprimée !"
        );

        return $this->redirectToRoute('admin_category_index');
    }
}
