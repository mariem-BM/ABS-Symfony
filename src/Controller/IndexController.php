<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ServiceType;
use App\Entity\Service;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class IndexController extends AbstractController
{
/**
*@Route("/")
*/
public function home()
{
return $this->render('base.html.twig');
}
/**
     * @Route("/back", name="first")
     */
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController',
        ]);
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


        return $this->render('Users/users.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }


    //Register Page

    /**
     * @Route("/register", name="register")
     */
    public function Register(): Response
    {


        return $this->render('Users/register.html.twig', [
            'controller_name' => 'FirstController',
        ]);
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


    //Ajout Service
    /**
     * @Route("/service/save")
     */
    public function save()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $service = new Service();
        $service->setNom('Service ');
        $service->setDescription('Description1');
        $service->setDetails('Details');
        $service->setImg('img');
        $entityManager->persist($service);
        $entityManager->flush();
        return new Response('Service enregisté avec id ' . $service->getId());
    }

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
$form = $this->createForm(ServiceType::class,$service);
$form->handleRequest($request);
if($form->isSubmitted() && $form->isValid()) {
$service = $form->getData();
$entityManager = $this->getDoctrine()->getManager();
$entityManager->persist($service);
$entityManager->flush();
return $this->redirectToRoute('service');
}
return $this->render('first/newService.html.twig',['form' => $form->createView()]);
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
        $form = $this->createForm(ServiceType::class,$service);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        return $this->redirectToRoute('service');
        }
        return $this->render('first/edit.html.twig', ['form' =>$form->createView()]);
        
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
        return $this->redirectToRoute('service');
    }
}