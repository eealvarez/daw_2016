<?php

namespace PruebaBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PruebaBundle\Entity\User;
use PruebaBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SeguridadController extends Controller
{
  public function registroAction(Request $request)
  {
      // 1) build the form
      $user = new User();
      $form = $this->createForm(UserType::class, $user);
      // 2) handle the submit (will only happen on POST)
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
          // 3) Encode the password (you could also do this via Doctrine listener)
          $password = $this->get('security.password_encoder')
              ->encodePassword($user, $user->getPlainPassword());
          $user->setPassword($password);
          $user->setRole("ROLE_USER");
          // 4) save the User!
          $em = $this->getDoctrine()->getManager();
          $em->persist($user);
          $em->flush();
          // ... do any other work - like sending them an email, etc
          // maybe set a "flash" success message for the user
          return new Response("Usuario registrado");
      }
      return $this->render(
          '@Prueba/Seguridad/registro.html.twig',
          array('form' => $form->createView())
      );
  }
  public function loginAction(Request $request)
  {
    $authenticationUtils = $this->get('security.authentication_utils');
    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();
    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();
    return $this->render('@Prueba/Seguridad/login.html.twig', array(
        'last_username' => $lastUsername,
        'error'         => $error,
    ));
  }
}
