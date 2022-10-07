<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Comments;
use App\Form\CommentType;
use App\Form\ArticlesType;
use Doctrine\ORM\Mapping\OrderBy;
use App\Repository\ArticlesRepository;
use App\Repository\CommentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/articles')]
class ArticlesController extends AbstractController
{
    #[Route('/', name: 'app_articles_index', methods: ['GET'])]
    public function index(ArticlesRepository $articlesRepository): Response
    {
        $articles =  $articlesRepository->findAll([],['id' => 'desc']);
        // $donnees = $articlesRepository->findAll([],['id' => 'desc']);
        // $articles = $paginator->paginate(
        //     $donnees, // Requête contenant les données à paginer (ici nos articles)
        //     $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
        //     6 // Nombre de résultats par page
        // );
        // $manager->persist($articles);
        // $manager->flush();
        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/new', name: 'app_articles_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $article = new Articles();
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $article->setUser($this->getUser());
            $article->setDate(new \DateTime());
            $manager->persist($article);
            $manager->flush();
            return $this->redirectToRoute('app_articles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('articles/new.html.twig', [
            'article' => $article,
            'form' => $form,

        ]);
    }

    #[Route('/{id}', name: 'app_articles_show', methods: ['GET', 'POST'])]
    public function show($id, Articles $article , Request $request, CommentsRepository $commentsRepository, ArticlesRepository $ArticlesRepository): Response
    {
        $comment = new Comments();
        $comments = $commentsRepository->findBy(['article' => $id]);
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        $article = $ArticlesRepository->find($id);

        if ($form->isSubmitted() && $form->isValid()) {

            $comment->setUser($this->getUser());
            $comment->setArticle($article);
            $comment->setDate(new \DateTime());
        }

        return $this->render('articles/show.html.twig', [
            'article' => $article,
             'comments' => $comments,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_articles_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Articles $article, ArticlesRepository $articlesRepository): Response
    {
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articlesRepository->add($article, true);

            return $this->redirectToRoute('app_articles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('articles/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_articles_delete', methods: ['POST'])]
    #[IsGranted(["ROLE_ADMIN"])]
    public function delete(Request $request, Articles $article, ArticlesRepository $articlesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $articlesRepository->remove($article, true);
        }

        return $this->redirectToRoute('app_articles_index', [], Response::HTTP_SEE_OTHER);
    }
}
