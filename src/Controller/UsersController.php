<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Entity\Account;
use App\Form\AccountType;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="users")
     */
    public function index(): Response
    {
        $accounts = $this->getDoctrine()->getRepository(Account::class)->findAll();
        return $this->render('users2/users.html.twig', ['accounts' => $accounts]);
    }
    /**
     * @Route("/login", name="login")
     */

    public function showAction(): Response
    {


        return  $this->render('Users/login.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }

    //Users list

    /**
     * @Route("/users", name="users")
     */
    public function showUsers(): Response
    {

        $accounts = $this->getDoctrine()->getRepository(Account::class)->findAll();
        return $this->render('users2/users.html.twig', ['accounts' => $accounts]);
    }


    //Register Page

    /**
     * @Route("/register", name="register")
     * Method({"GET", "POST"})
     */

    public function Register(Request $request)

    {

        $account = new account();
        $form = $this->createForm(AccountType::class, $account);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('profilePicture')->getData();
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
                $account->setProfilePicture($newFilename);
            }
            $account = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($account);
            $entityManager->flush();
            return $this->redirectToRoute('login');
        }
        return $this->render('users2/addaccount.html.twig', ['form' => $form->createView()]);
    }

    //Forget-Password Page

    /**
     * @Route("/forget-password", name="forget-password")
     */
    public function ForgetPassword(): Response
    {


        return $this->render('Users/forget-password.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }
    //account details

    /**
     * @Route("/users/{id}", name="users2")
     *  
     */
    public function AccountDetails($id)
    {
        $account = $this->getDoctrine()->getRepository(Account::class)->find($id);

        return $this->render(
            'users2/detailsaccount.html.twig',
            array('account' => $account)
        );
    }

    //Edit Service

    /**
     * @Route("/account/edit/{id}", name="edit_account")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id)
    {
        $account = new Account();
        $account = $this->getDoctrine()->getRepository(account::class)->find($id);
        $form = $this->createForm(AccountType::class, $account);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('profilePicture')->getData();
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
                $account->setProfilePicture($newFilename);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('account');
        }
        return $this->render('users2/edit.html.twig', ['form' => $form->createView()]);
    }


    //DELETE account

    /**
     * @Route("/account/delete/{id}",name="delete_account")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id)
    {
        $account = $this->getDoctrine()->getRepository(Account::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($account);
        $entityManager->flush();
        $response = new Response();
        $response->send();
        return $this->redirectToRoute('account');
    }
}
