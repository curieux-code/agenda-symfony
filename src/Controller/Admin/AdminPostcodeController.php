<?php

namespace App\Controller\Admin;

use App\Entity\Postcode;
use App\Service\Paginator;
use App\Form\PostcodeType;
use App\Repository\PostcodeRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPostcodeController extends AbstractController
{
    /**
     * @Route("/admin/code-postal/{page<\d+>?1}", name="admin_postcode_index")
     */
    public function index(PostcodeRepository $repo, $page, Paginator $paginator, Request $request, ObjectManager $manager)
    {
        $paginator  ->setEntityClass(Postcode::class)
                    ->setPage($page);

        $postcode = new Postcode();

        $form = $this->createForm(PostcodeType::class, $postcode);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($postcode);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le code postal <b>{$postcode->getCode()}</b> a bien été enregistré !"
            );

            return $this->redirectToRoute('admin_postcode_index');
        }

        return $this->render('admin/postcode/index.html.twig', [
            'paginator' => $paginator,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'éditer un code postal dans l'admin
     *
     * @Route("/admin/code-postal/{id}/editer", name="admin_postcode_edit")
     * 
     * @param Postcode $postcode
     * @return Response
     */
    public function edit(Postcode $postcode, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(PostcodeType::class, $postcode);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($postcode);
            $manager->flush();

            $this->addFlash(
                'success',
                "<div class='row'>
                <div class='col'>
                Le code postal '{$postcode->getCode()}' a bien été modifié !<br>
                </div>
                <div class='col text-right'>
                    <a href='../' class='btn btn-primary'>Revenir sur la liste des codes postaux</a>
                </div>
            </div>"
            );
        }

        return $this->render('admin/postcode/edit.html.twig', [
            'form' => $form->createView(),
            'postcode' => $postcode
        ]);
    }

    /**
     * Permet de supprimer un code postal
     *
     * @Route("/admin/code-postal/{id}/supprimer", name="admin_postcode_delete")
     * 
     * @param Postcode $postcode
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Postcode $postcode, ObjectManager $manager){
        $manager->remove($postcode);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le code postal <b>'{$postcode->getCode()}'</b> a bien été supprimé !"
        );

        return $this->redirectToRoute('admin_postcode_index');
    }
}
