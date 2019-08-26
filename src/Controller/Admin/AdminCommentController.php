<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Service\Paginator;
use App\Form\AdminCommentType;
use App\Repository\CommentRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCommentController extends AbstractController
{
    /**
     * @Route("/admin/commentaires/{page<\d+>?1}", name="admin_comment_index")
     */
    public function index(CommentRepository $repo, $page, Paginator $paginator)
    {

        $paginator  ->setEntityClass(Comment::class)
                    //->setLimit(100)
                    //->setRoute('admin_comment_index')
                    ->setPage($page);

        return $this->render('admin/comment/index.html.twig', [
            //'comments' => $repo->findAll()
            'paginator' => $paginator
        ]);
    }

    
    /**
     * Permet de modifier un commentaire
     *
     * @Route("/admin/comment/{id}/edit", name="admin_comment_edit")
     * 
     * @param Comment $comment
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function edit(Comment $comment, Request $request, ObjectManager $manager) {

        $form = $this->createForm(AdminCommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($comment);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le commentaire n '{$comment->getId()}' a bien été modifiée !"
            );
        }

        return $this->render('admin/comment/edit.html.twig', [
            'comment' => $comment,
            'form' => $form->createView()
        ]);
    }

    
    /**
     * Permet de supprimer un commentaire
     *
     * @Route("/admin/comment/{id}/delete", name="admin_comment_delete")
     * 
     * @param Comment $comment
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Comment $comment, ObjectManager $manager){
        $manager->remove($comment);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le commentaire de <strong>'{$comment->getAuthor()->getFullName()}'</strong> dans l'évènement <strong>'{$comment->getEvent()->getTitle()}'</strong> a bien été supprimée !"
        );

        return $this->redirectToRoute('admin_comment_index');
    }
}
