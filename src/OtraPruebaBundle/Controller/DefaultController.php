<?php

namespace OtraPruebaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="otraprueba_home")
     */
    public function indexAction()
    {
        return $this->render('@OtraPrueba/Default/index.html.twig');
    }
 
//ASÍ ES COMO ORIGINALMENTE SE IZO EN EL VIDEO DE SYMFONY 3 08 - CRANDO PÁGINAS ESTÁTICAS DEL VIDEO DE PACO GÓMEZ 
//    /**
//     * @Route("/nombre", name="otraprueba_nombre")
//     */
//    public function nombreAction()
//    {
//        return $this->render('@OtraPrueba/Default/nombre.html.twig');
//    }
    
    /**
     * @Route("/nombre/{nombre}", name="otraprueba_nombre")
     */
    public function nombreAction($nombre='Sin nombre')
    {
        return $this->render('@OtraPrueba/Default/nombre.html.twig', array('nombre' => $nombre));
    }
    
    /**
     * @Route("/nombre/", name="otraprueba_nombre_sin_parametro")
     */
    public function nombreSinParamAction()
    {
        return $this->render('@OtraPrueba/Default/index.html.twig');
    }
    
    /**
     * @Route("/redireccion")
     */
    public function redireccionAction()
    {
        //ASÍ ES COMO ORIGINALMENTE SE IZO EN EL VIDEO DE SYMFONY 3 10b - REDIRECCIONES DEL VIDEO DE PACO GÓMEZ 
        //return $this->render('@OtraPrueba/Default/redireccion.html.twig');
        
        return $this->redirectToRoute('otraprueba_home');
    }
}
