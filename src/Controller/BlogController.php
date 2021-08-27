<?php

namespace App\Controller;
use App\Entity\Article;
use App\Entity\Category;
use App\Form\ArticleType;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;








class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function article(): Response
    {
        
         //récupérer tous les articles de la table article de la BDet les mettre dans le tableau $articles
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
        return $this->render('blog/index.html.twig', ['articles' => $articles]);
    }
     //Ajout 
    /**
     * @Route("/add", name="add")
     */
    public function add(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class,$article);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
        $article = $form->getData();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($article);
        $entityManager->flush();
        return $this->redirectToRoute('blog');
        }
        return $this->render('blog/add.html.twig', [
            'form' => $form->createView()
        ]);
        
    }
    
    //Details

    /**
     * @Route("/article/{id}", name="article_details")
     */
    public function show($id)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        return $this->render(
            'blog/details.html.twig',
            array('article' => $article)
        );
    }

    //Edit 

    /**
     * @Route("/article/edit/{id}", name="edit_article")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id)
    {
        $article = new Article();
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        $form = $this->createForm(ArticleType::class,$article);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        return $this->redirectToRoute('blog');
        }
        return $this->render('blog/edit.html.twig', ['form' =>$form->createView()]);
        
    }

    //DELETE 

    /**
     * @Route("/article/delete/{id}",name="delete_article")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($article);
        $entityManager->flush();
        $response = new Response();
        $response->send();
        return $this->redirectToRoute('blog');
    }



   
    



}
