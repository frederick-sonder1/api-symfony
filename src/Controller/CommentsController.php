<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Form\CommentType;
use App\Repository\CommentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
            'form' => $form,
        ]);
    }

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
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_Comments_delete', methods: ['POST'])]
    #[IsGranted(["ROLE_ADMIN"])]
    public function delete(Request $request, Comments $comments, CommentsRepository $CommentsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comments->getId(), $request->request->get('_token'))) {
            $CommentsRepository->remove($comments, true);
        }

        return $this->redirectToRoute('app_Comments_index', [], Response::HTTP_SEE_OTHER);
    }
}

