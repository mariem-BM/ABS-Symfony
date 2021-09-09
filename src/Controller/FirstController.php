<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Service;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

use App\Form\ServiceType;
use App\Entity\Article;
use App\Form\ArticleType;
use App\Entity\Pages;
use App\Form\PagesType;
use App\Entity\References;
use App\Form\RefrenceType;
use App\Entity\Formulaire;
use App\Form\FormulaireType;



class FirstController extends AbstractController
{


    /**
     *@Route("/home", name="home")
     */
    public function home(Request $request)
    {
        //return $this->render('base.html.twig');
        $services = $this->getDoctrine()->getRepository(Service::class)->findAll();
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
        $pages = $this->getDoctrine()->getRepository(Pages::class)->findAll();
        $refrencess = $this->getDoctrine()->getRepository(References::class)->findAll();
        $formulaire = new Formulaire();
        $form = $this->createForm(FormulaireType::class, $formulaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $formulaire = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formulaire);
            $entityManager->flush();
            $this->addFlash('success', 'Message Sent Thank you for contacting us!');
            return $this->redirectToRoute('home');
        }
        return $this->render('base.html.twig', [
            'services' => $services,
            'refrencess' => $refrencess,
            'articles' => $articles,
            'pages' => $pages,
            'form' => $form->createView(),

        ]);



        return $this->render('inc/section10.html.twig', [
            'form' => $form->createView()
        ]);
    }







    //****************************************Back*********************************/


    /**
     * @Route("/back", name="first")
     */
    public function index(): Response
    {
        return $this->render('template.html.twig');
    }

    //Userss controller




    /**
     *@Route("/service",name="service")
     */
    public function service()
    {
        //récupérer tous les articles de la table article de la BD
        // et les mettre dans le tableau $articles
        $services = $this->getDoctrine()->getRepository(Service::class)->findAll();
        return $this->render('first/service.html.twig', ['services' => $services]);
    }


    //Ajout Service

    /**
     * @Route("/service/new", name="service/new")
     * Method({"GET", "POST"})
     */
    public function new(Request $request)
    {

        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('img')->getData();
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
                $service->setImg($newFilename);
            }
            $service = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($service);
            $entityManager->flush();
            $this->addFlash('success', 'Service Created!');
            return $this->redirectToRoute('service');
        }
        return $this->render('first/newService.html.twig', ['form' => $form->createView()]);
    }

    //Services Details

    /**
     * @Route("/service/{id}", name="details_show")
     */
    public function show($id)
    {
        $service = $this->getDoctrine()->getRepository(Service::class)->find($id);

        return $this->render(
            'first/details.html.twig',
            array('service' => $service)
        );
    }


    //Edit Service

    /**
     * @Route("/service/edit/{id}", name="edit_service")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id)
    {
        $service = new Service();
        $service = $this->getDoctrine()->getRepository(service::class)->find($id);
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('img')->getData();
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
                $service->setImg($newFilename);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash('success', 'Service Edited!');
            return $this->redirectToRoute('service');
        }
        return $this->render('first/edit.html.twig', ['form' => $form->createView()]);
    }
    //DELETE Service

    /**
     * @Route("/service/delete/{id}",name="delete_service")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id)
    {
        $service = $this->getDoctrine()->getRepository(Service::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($service);
        $entityManager->flush();
        $response = new Response();
        $response->send();
        $this->addFlash('success', 'Service Deleted!');
        return $this->redirectToRoute('service');
    }

    /*******************************front */
    /**
     *@Route("/servicefront",name="servicefront")
     */
    public function servicefront()
    {
        //récupérer tous les articles de la table article de la BD
        // et les mettre dans le tableau $articles
        $services = $this->getDoctrine()->getRepository(Service::class)->findAll();
        return $this->render('inc/section3.html.twig', ['services' => $services]);
    }
}
