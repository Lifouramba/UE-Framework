<?php

namespace App\Controller;
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

class FormulaireController extends AbstractController
{
    /**
     * @Route("/formulaire", name="auth_formulaire")
     *
     * @param Request $request
     * @return Response
     */
    public function login(  Request $request)
    {

                $builder = $this->createFormBuilder();

                $builder ->add('email', EmailType::class)
                ->add('plainPassword', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'invalid_message' => 'Vos mots de passes ne concordent pas',
                    'options' => ['attr' => ['class' => 'password-field']],
                    'required' => true,
                    'first_options'  => ['label' => false, 'attr' => array(
                        'placeholder' => 'saisir mot de passe...',
                    )],
                    'second_options' => ['label' => false,'attr' => array(
                        'placeholder' => 'saisir à nouveau mot de passe...',
                    ),],
                    'mapped' => false,
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Please enter a password',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Your password should be at least {{ limit }} characters',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                ))
                ->add('btSubmit', SubmitType::class);

            $form = $builder->getForm();


            $form ->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){

                return new Response("le formulaire est valide");
            }else{
                $infoRendu = $form->createView();
                return $this->render("formulaire/formulaire.html.twig", ["infoForm"=>$infoRendu]);
            }

    }
}