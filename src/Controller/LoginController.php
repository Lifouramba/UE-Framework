<?php

namespace App\Controller;

use App\Entity\Login;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login", methods={"POST","GET"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $user= new User();
        $builder = $this->createFormBuilder();

        $builder ->add('email', EmailType::class)
                ->add('password')
                ->add('btSubmit', SubmitType::class);
        $form = $builder->getForm();

        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            if($form->getData()['email']!=$user->getEmail()||$form->getData()['password']!=$user->getPassword())
            {
                $this->addFlash('erreur_login',"problème email ou password");
                return $this->redirectToRoute('login');
            }
            if($form->getData()['email']==$user->getEmail()||$form->getData()['password']==$user->getPassword())
            {
                return new Response("le formulaire est valide");
            }
        }

        $infoRendu = $form->createView();
        return $this->render("login/index.html.twig", ["infoForm"=>$infoRendu]);
    }
}
