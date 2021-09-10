<?php

namespace App\Controller;

use App\Entity\References;
use App\Form\RefrenceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Twig\Extra\String\StringExtension;

class RefrencesController extends AbstractController
{
    /**
     * @Route("/refrences", name="refrences")
     */
    public function refrences()
    {
        //récupérer tous les articles de la table article de la BDet les mettre dans le tableau $articles
        $refrencess = $this->getDoctrine()->getRepository(References::class)->findAll();
        return $this->render('refrences/refrences.html.twig', ['refrencess' => $refrencess]);
    }



    //Ajout 
    /**
     * @Route("/addref", name="addref")
     */
    public function addref(Request $request)
    {
        $refrences = new References();
        $form = $this->createForm(RefrenceType::class, $refrences);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('imgRef')->getData();
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
                $refrences->setImgRef($newFilename);
            }
            $refrences = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($refrences);
            $entityManager->flush();
            $this->addFlash('success', 'Refrence Created!');
            return $this->redirectToRoute('refrences');
        }
        return $this->render('refrences/addref.html.twig', [
            'form' => $form->createView()
        ]);
    }

    //Edit 

    /**
     * @Route("/refrences/edit/{id}", name="edit_refrences")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id)
    {
        $refrences = new References();
        $refrences = $this->getDoctrine()->getRepository(References::class)->find($id);
        $form = $this->createForm(RefrenceType::class, $refrences);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('imgRef')->getData();
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
                $refrences->setImgRef($newFilename);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash('success', 'Refrence Edited!');
            return $this->redirectToRoute('refrences');
        }
        return $this->render('refrences/editref.html.twig', ['form' => $form->createView()]);
    }

    //DELETE 

    /**
     * @Route("/refrences/delete/{id}",name="delete_refrences")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id)
    {
        $refrences = $this->getDoctrine()->getRepository(References::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($refrences);
        $entityManager->flush();
        $response = new Response();
        $response->send();
        $this->addFlash('success', 'Refrence Deleted!');
        return $this->redirectToRoute('refrences');
    }
    /***********************************************test */
    /**
     * @Route("/refrencesfront", name="refrencesfront")
     */
    public function refrencesfront()
    {
        //récupérer tous les articles de la table article de la BDet les mettre dans le tableau $articles
        $refrencess = $this->getDoctrine()->getRepository(References::class)->findAll();
        return $this->render('carousel.html.twig', ['refrencess' => $refrencess]);
    }
}
