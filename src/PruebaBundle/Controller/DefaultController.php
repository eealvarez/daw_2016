<?php

namespace PruebaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Prueba/Default/index.html.twig');
    }
    
    public function contactarAction($lugar)
    {
        if($lugar=='vlc')
        {
            return $this->redirect($this->generateUrl('prueba_contactar_vlc'));
        }elseif($lugar=='mdr')
        {
            return $this->render('@Prueba/Default/index.html.twig');
        }else{
            //así lo hice primero esta línea
            //return $this->redirect('http://www.google.com');
            
            throw $this->createNotFoundException('Estás equivocado');      //esto funciona debido api controller
        }
        //return $this->render('@Prueba/Default/index.html.twig');
    }
    
// ASÍ ES COMO ORIGINALMENTE SE IZO EN EL VIDEO DE SYMFONY 3 08 - CRANDO PÁGINAS ESTÁTICAS DEL VIDEO DE PACO GÓMEZ  
//        public function nombreAction()
//    {
//        return $this->render('@Prueba/Default/nombre.html.twig');
//    }
    
    public function contactarVlcAction()
    {
        return $this->render('@Prueba/Default/contactarVlc.html.twig');   //para éste método render, $this hace referencia a use Symfony\Bundle\FrameworkBundle\Controller\Controller;, porque dentro de esa clase Controller está el método render
    }
    
    public function nombreAction($nombre)
    {
        return $this->render('@Prueba/Default/nombre.html.twig', array('nombre' => $nombre, 'usuario'=>true));   //para éste método render, $this hace referencia a use Symfony\Bundle\FrameworkBundle\Controller\Controller;, porque dentro de esa clase Controller está el método render
    }
    
    public function nombreRAction($nombre)  //objeto Response. En este caso no vamos a devolver un render sino que vamos a utilizar un Response, para esto necesitamos incluir use Symfony\Component\HttpFoundation\Response; arriba en la cabecera
    {
        return new Response('<html><head></head><body><h2>Hola '.$nombre.'</h2></body></html>');
    }
    
    public function nombresAction()
    {
        
        $nombres=[
            
            "Paco"=>[
                "nombre"=>"Paco",
                "activo"=>true
            ], 
            "Luis"=>[
                "nombre"=>"Luis",
                "activo"=>false
            ], 
            "María"=>[
                "nombre"=>"María",
                "activo"=>true
            ]];
        
        return $this->render('@Prueba/Default/nombres.html.twig', array('nombres'=>$nombres));   //para éste método render, $this hace referencia a use Symfony\Bundle\FrameworkBundle\Controller\Controller;, porque dentro de esa clase Controller está el método render
    }
}
