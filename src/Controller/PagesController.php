<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pages;
use App\Form\PagesType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;



class PagesController extends AbstractController
{
    /**
     * @Route("/", name="pages")
     */
    public function index(): Response
    {
        return $this->render('pages/pages.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }

    //Show

    /**
     *@Route("/pages",name="pages")
     */
    public function pages()
    {
        //récupérer tous les articles de la table article de la BD
        // et les mettre dans le tableau $articles
        $pages = $this->getDoctrine()->getRepository(Pages::class)->findAll();
        return $this->render('pages/pages.html.twig', ['pages' => $pages]);
    }

    //Pages Details

    /**
     * @Route("/pages/{id}", name="details_show")
     */
    public function show($id)
    {
        $page = $this->getDoctrine()->getRepository(Pages::class)->find($id);

        return $this->render(
            'pages/pagesDetails.html.twig',
            array('page' => $page)
        );
    }



    //Add

    /**
     * @Route("/addpages", name="addpages")
     */

    public function addPages(Request $request)
    {
        $page = new Pages();
        $form = $this->createForm(PagesType::class, $page);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('imgPages')->getData();
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $page->setImgPages($newFilename);
            }
            $page = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($page);
            $entityManager->flush();
            return $this->redirectToRoute('pages');
        }
        return $this->render('pages/addPages.html.twig', [
            'form' => $form->createView()
        ]);
    }

    //EditPages
    //Edit 

    /**
     * @Route("/pages/edit/{id}", name="edit_page")
     * Method({"GET", "POST"})
     */

    public function editPages(Request $request, $id)
    {
        $page = new Pages();
        $page = $this->getDoctrine()->getRepository(Pages::class)->find($id);
        $form = $this->createForm(PagesType::class, $page);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('pages');
        }
        return $this->render('pages/editPages.html.twig', ['form' => $form->createView()]);
    }

    //Delete Pages
    //DELETE 

    /**
     * @Route("/pages/delete/{id}",name="delete_page")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id)
    {
        $page = $this->getDoctrine()->getRepository(Pages::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($page);
        $entityManager->flush();
        $response = new Response();
        $response->send();
        return $this->redirectToRoute('pages');
    }
}
