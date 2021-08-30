<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
     * @Route("/register", name="register2")
     * Method({"GET", "POST"})
     */

    public function Register(Request $request)

    {

        $account = new account();
        $form = $this->createForm(AccountType::class, $account);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
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
    //accout details

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
}
