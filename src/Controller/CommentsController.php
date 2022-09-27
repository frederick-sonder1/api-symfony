<?php

namespace App\Controller;

use App\Entity\Comments;
<<<<<<< HEAD
use App\Form\CommentType;
=======
use App\Form\CommentsType;
>>>>>>> b12cba42dd232577b4d22083e3d43b9865c9fb02
use App\Repository\CommentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

<<<<<<< HEAD
#[Route('/comment')]
class CommentsController extends AbstractController
{
 
    #[Route('/', name: 'app_Comments_index', methods: ['GET'])]
    public function index(CommentsRepository $CommentsRepository): Response
    {
        return $this->render('Comments/index.html.twig', [
            'Comments' => $CommentsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_Comments_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CommentsRepository $CommentsRepository): Response
    {
        $comments = new Comments();
        $form = $this->createForm(CommentType::class, $comments);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $CommentsRepository->add($comments, true);

            return $this->redirectToRoute('app_Comments_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Comments/new.html.twig', [
            'Comments' => $comments,
=======
#[Route('/comments')]
class CommentsController extends AbstractController
{
    #[Route('/', name: 'app_comments_index', methods: ['GET'])]
    public function index(CommentsRepository $commentsRepository): Response
    {
        return $this->render('comments/index.html.twig', [
            'comments' => $commentsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_comments_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CommentsRepository $commentsRepository): Response
    {
        $comment = new Comments();
        $form = $this->createForm(CommentsType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentsRepository->add($comment, true);

            return $this->redirectToRoute('app_comments_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('comments/new.html.twig', [
            'comment' => $comment,
>>>>>>> b12cba42dd232577b4d22083e3d43b9865c9fb02
            'form' => $form,
        ]);
    }

<<<<<<< HEAD
    #[Route('/{id}', name: 'app_Comments_show', methods: ['GET'])]
    public function show(Comments $comments): Response
    {
        return $this->render('Comments/show.html.twig', [
            'Comments' => $comments,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_Comments_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Comments $comments, CommentsRepository $CommentsRepository): Response
    {
        $form = $this->createForm(CommentType::class, $comments);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $CommentsRepository->add($comments, true);

            return $this->redirectToRoute('app_Comments_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Comments/edit.html.twig', [
            'Comments' => $comments,
=======
    #[Route('/{id}', name: 'app_comments_show', methods: ['GET'])]
    public function show(Comments $comment): Response
    {
        return $this->render('comments/show.html.twig', [
            'comment' => $comment,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_comments_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Comments $comment, CommentsRepository $commentsRepository): Response
    {
        $form = $this->createForm(CommentsType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentsRepository->add($comment, true);

            return $this->redirectToRoute('app_comments_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('comments/edit.html.twig', [
            'comment' => $comment,
>>>>>>> b12cba42dd232577b4d22083e3d43b9865c9fb02
            'form' => $form,
        ]);
    }

<<<<<<< HEAD
    #[Route('/{id}', name: 'app_Comments_delete', methods: ['POST'])]
    public function delete(Request $request, Comments $comments, CommentsRepository $CommentsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comments->getId(), $request->request->get('_token'))) {
            $CommentsRepository->remove($comments, true);
        }

        return $this->redirectToRoute('app_Comments_index', [], Response::HTTP_SEE_OTHER);
    }
}

=======
    #[Route('/{id}', name: 'app_comments_delete', methods: ['POST'])]
    public function delete(Request $request, Comments $comment, CommentsRepository $commentsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
            $commentsRepository->remove($comment, true);
        }

        return $this->redirectToRoute('app_comments_index', [], Response::HTTP_SEE_OTHER);
    }
}
>>>>>>> b12cba42dd232577b4d22083e3d43b9865c9fb02
