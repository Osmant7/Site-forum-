<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AccountController extends AbstractController {

    
    /**
     * @Route("/inscription", name="inscription_registration")
     */
    public function registration(Request $request, UserPasswordEncoderInterface $encoder){

        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('security_login');
        }

        return $this->render('Inscription/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/connexion", name="security_login")
     */
    public function login(){
        return $this->render('connexion/login.html.twig');
    }

     /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout() {}

    /**
     * @Route("/staff", name="staff")
     */
    public function staff(): Response
    {
        return $this->render('staff/index.html.twig', [
            'controller_name' => 'StaffController',
        ]);
    }

    // public function Users() {
    //     $rep = $this->getDoctrine()->getRepository(User::class);
    //     $theUser = $rep->findAll();
    // }

}
