<?php

namespace App\Controller\Admin;

use App\Entity\Department;
use App\Service\Paginator;
use App\Form\DepartmentType;
use App\Repository\DepartmentRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDepartmentController extends AbstractController
{
    /**
     * @Route("/admin/departement/{page<\d+>?1}", name="admin_department_index")
     */
    public function index(DepartmentRepository $repo, $page, Paginator $paginator, Request $request, ObjectManager $manager)
    {
        $paginator  ->setEntityClass(Department::class)
                    ->setPage($page);

        $department = new Department();

        $form = $this->createForm(DepartmentType::class, $department);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($department);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le département <b>{$department->getName()}</b> a bien été enregistré !"
            );

            return $this->redirectToRoute('admin_department_index');
        }

        return $this->render('admin/department/index.html.twig', [
            'paginator' => $paginator,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'éditer une billetterie dans l'admin
     *
     * @Route("/admin/departement/{id}/editer", name="admin_department_edit")
     * 
     * @param Department $department
     * @return Response
     */
    public function edit(Department $department, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(DepartmentType::class, $department);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($department);
            $manager->flush();

            $this->addFlash(
                'success',
                "<div class='row'>
                    <div class='col'>
                        Le département '{$department->getName()}' a bien été modifiée !<br>
                    </div>
                    <div class='col text-right'>
                        <a href='../' class='btn btn-primary'>Revenir sur la liste des départements</a>
                    </div>
                </div>"
            );
        }

        return $this->render('admin/department/edit.html.twig', [
            'form' => $form->createView(),
            'department' => $department
        ]);
    }

    /**
     * Permet de supprimer une billetterie
     *
     * @Route("/admin/departement/{id}/supprimer", name="admin_department_delete")
     * 
     * @param Department $department
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Department $department, ObjectManager $manager){
        $manager->remove($department);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le département <b>'{$department->getName()}'</b> a bien été supprimée !"
        );

        return $this->redirectToRoute('admin_department_index');
    }
}
