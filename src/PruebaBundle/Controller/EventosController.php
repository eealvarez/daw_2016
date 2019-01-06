<?php

namespace PruebaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PruebaBundle\Entity\Categorias;     //porque vamos a hacer uso de ella mediante una instancia que se crea en las actions correspondientes
use PruebaBundle\Entity\Eventos;        //porque vamos a hacer uso de ella mediante una instancia que se crea en las actions correspondientes
use PruebaBundle\Form\EventosType;      //esto para usar el formulario EventosType.php
use Symfony\Component\HttpFoundation\Request;       //esto para usar el Request para capturar datos  de nuestro formulario, esto en la acción nuevoAction por ejemplo

class EventosController extends Controller
{
    public function allAction()
    {
        $repository = $this->getDoctrine()->getRepository('PruebaBundle:Eventos');
        
        //find *all* products, en este caso sería find *all* events
        $events = $repository->findAll();
        
        return $this->render('@Prueba/Eventos/all.html.twig', array("eventos" => $events));
    }
    
    public function crearEventoAction()
    {
        //Nuevo objeto de tipo Evento
        $evento = new Eventos();
                
        $evento->setNombreEvento("evento ear");
        $evento->setFecha( new \DateTime);
        $evento->setCiudad("El Estor");
        $evento->setPoblacion("Izabal");
        
        //Doctrine
        $mangDoct = $this->getDoctrine()->getManager();
        $mangDoct->persist($evento);
        $mangDoct->flush($evento);
        
        return $this->render('@Prueba/Eventos/crearEvento.html.twig', array("eventoId"=>$evento->getId()));     //"eventoId" es la variable del array asociativo a la cual se le está asignando el id que se está obteniendo con el getId(), que es el getter del campo id del objeto $evento que es una instancia de la entidad Eventos
    }

    public function buscarEventoAction($id)
    {
        //Recuperar el repositorio de la entidad Eventos. Esta es una clase de doctrine cuando queremos realizar una búsqueda
        $repository = $this->getDoctrine()->getRepository('PruebaBundle:Eventos');
        $evento = $repository->find($id);
        //$evento = $repository->findOneById($id);
        
        return $this->render('@Prueba/Eventos/evento.html.twig', array("id"=>$evento->getId(), "nombre"=>$evento->getNombreEvento()));
    }
    
        public function buscarEventoPorNombreAction($nombre)
        {
            //Recuperar el repositorio de la entidad Evento
            $repository = $this->getDoctrine()->getRepository('PruebaBundle:Eventos');
            $evento = $repository->findOneByNombreEvento($nombre);      //findOneByNombreEvento, siempre se coloca seguido de findOneBy, el nombre del campo en formato Camel Case, por ejemplo si solo quisiéramos en este caso que busque por ciudad que es otro de los campos que tenemos en la entidad y por consiguiente en la base de datos, entonces se coloca así: findOneByCiudad($variable);
                    
            return $this->render('@Prueba/Eventos/evento.html.twig', array("id"=>$evento->getId(), "nombre"=>$evento->getNombreEvento()));
        }
        
        public function nuevoAction(Request $request)       //para esto hay que incluir la librería 
        {
            $evento = new Eventos();
            //ASÍ ERA PARA LA VERSIÓN DE SYMFONY 2.8:
            //$form = $this->createForm(new EventosType());
            //PERO PARA LA VERSISÓN DE SYMFONY 3.4.19 ES ASÍ:
            $form = $this->createForm(EventosType::class, $evento);
            $form->handleRequest($request);     //vamos capturar lo que vaya hacer el $form, lo que vaya hacer el nuevoAction
            
            if($form->isSubmitted() && $form->isValid())
            {
                // $form->getData() holds the submitted values
                // but, the original `$task` variable has also been updated
                $evento = $form->getData();

                // ... perform some action, such as saving the task to the database
                // for example, if Task is a Doctrine entity, save it!
                $em = $this->getDoctrine()->getManager();
                $em->persist($evento);
                $em->flush();

                return $this->redirectToRoute('exito_eventos');
            }
            
            return $this->render('@Prueba/Eventos/nuevo.html.twig', array("form"=>$form->createView()));
        }
        
        public function msgExitoAction()
        {
            return $this->redirect($this->generateUrl('nuevo_eventos'));
        }
        
        public function nuevoConCatAction()
        {
            //Categoria generada. Esto solo es si necesitamos una nueva categoria, en caso de no necesitar una categoria nueva entonces debemos comentariar esto las siguients dos líneas. Si la categoría ya existiera, entonces solo haríamos un find y directamente le añadiríamos la categoría dentro de eventos
            $categoria = new Categorias();
            $categoria->setNombre("Fiestas");
            
            //Nuevo evento para esa categoria. Setiamos todos los campos que contiene la tabla eventos en nuestra base de datos, porque son not null
            $evento = new Eventos();
            $evento->setNombreEvento("Cabalgata");
            $evento->setFecha( new \DateTime());    //dejamos en blanco DateTime() para que coloque la fecha en curso
            $evento->setCiudad("Valencia");
            $evento->setPoblacion("Torrent");
            
            //ligar la categoria a nuestro evento
            $evento->setCategoria($categoria);
            
            //Guardar en la Base de Datos
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoria);
            $em->persist($evento);
            $em->flush();

            return $this->redirectToRoute('all_eventos');
        }
    
}
