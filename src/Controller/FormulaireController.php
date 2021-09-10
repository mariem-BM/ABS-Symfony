<?php

namespace App\Controller;

use App\Entity\Formulaire;
use App\Form\FormulaireType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FormulaireController extends AbstractController
{
    /**
     * @Route("/formulaire", name="formulaire")
     */
    public function formulaire(): Response
    {
        $formulaires = $this->getDoctrine()->getRepository(Formulaire::class)->findAll();
        return $this->render('formulaire/formulaire.html.twig', ['formulaires' => $formulaires]);
    }


    //Ajout 
    /**
     * @Route("/addform", name="addform")
     */
    public function addref(Request $request,ValidatorInterface $validator)
    {
        $formulaire = new Formulaire();
        $form = $this->createForm(FormulaireType::class, $formulaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $errors = $validator->validate($article);

            if (count($errors) > 0) {
                /*
                 * Uses a __toString method on the $errors variable which is a
                 * ConstraintViolationList object. This gives us a nice string
                 * for debugging.
                 */
                $errorsString = (string) $errors;
        
                return new Response($errorsString);
            }
            
            $formulaire = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formulaire);
            $entityManager->flush();
            $this->addFlash('success', 'Message Sent!');
            return $this->redirectToRoute('formulaire');
        }
        return $this->render('formulaire/addform.html.twig', [
            'form' => $form->createView()
        ]);
    }

    //Edit 

    /**
     * @Route("/formulaire/edit/{id}", name="edit_formulaire")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id)
    {
        $formulaire = new Formulaire();
        $formulaire = $this->getDoctrine()->getRepository(Formulaire::class)->find($id);
        $form = $this->createForm(FormulaireType::class, $formulaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash('success', 'Message Edited!');
            return $this->redirectToRoute('formulaire');
        }
        return $this->render('formulaire/editform.html.twig', ['form' => $form->createView()]);
    }

    //DELETE 

    /**
     * @Route("/formulaire/delete/{id}",name="delete_formulaire")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id)
    {
        $formulaire = $this->getDoctrine()->getRepository(Formulaire::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($formulaire);
        $entityManager->flush();
        $response = new Response();
        $response->send();
        $this->addFlash('success', 'Message Deleted!');
        return $this->redirectToRoute('formulaire');
    }
    /**********************************front */
     /**
     * @Route("/formulairefront", name="formulairefront")
     */
    public function formulairefront(): Response
    {
        $formulaires = $this->getDoctrine()->getRepository(Formulaire::class)->findAll();
        return $this->render('formulaire/formulaire.html.twig', ['formulaires' => $formulaires]);
    }


    //Ajout 
    /**
     * @Route("/addformfront", name="addformfront")
     */
    public function addreffront(Request $request)
    {
        $formulaire = new Formulaire();
        $form = $this->createForm(FormulaireType::class, $formulaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $formulaire = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formulaire);
            $entityManager->flush();
            $this->addFlash('success', 'Message Sent Thank you for contacting us!');
            return $this->redirectToRoute('formulaire');
        }
        return $this->render('formulaire/addform.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
