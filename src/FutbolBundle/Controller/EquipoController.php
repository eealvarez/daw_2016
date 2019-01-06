<?php

namespace FutbolBundle\Controller;

use FutbolBundle\Entity\Equipo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Equipo controller.
 *
 */
class EquipoController extends Controller
{
    /**
     * Lists all equipo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $equipos = $em->getRepository('FutbolBundle:Equipo')->findAll();

        return $this->render('equipo/index.html.twig', array(
            'equipos' => $equipos,
        ));
    }

    /**
     * Creates a new equipo entity.
     *
     */
    public function newAction(Request $request)
    {
            //ESTO FUE ORIGINAL O INICIALMENTE
//        $equipo = new Equipo();
//        $form = $this->createForm('FutbolBundle\Form\EquipoType', $equipo);
//        //var_dump($request); //cuando aún no se ha introducido el formulario, cuando no se ha introducido ningún dato al formulario aún        
//        //pero si ahora queremos saber qué está pasando con los datos que está enviando el formulario, entonces le podemos agregar la propiedad request dentro del obejto $request:
//        ////var_dump($request->request);
//        // la línea anterior en la que le agregamos la propiedad request al objeto $request, la propiedad request no es más que un parameterBag, un objeto de tipo parameterBag, que si utilizacemos el all devolveríamos todos los parámetros que se han enviado, de esta manera:
//        var_dump($request->request->all());
//        
//        $form->handleRequest($request);
        
//            if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($equipo);
//            $em->flush();
//
//            return $this->redirectToRoute('equipo_show', array('id' => $equipo->getId()));
//        }
//
//        return $this->render('equipo/new.html.twig', array(
//            'equipo' => $equipo,
//            'form' => $form->createView(),
//        ));
        
        //AHORA PARA SABER QUÉ OCURRE CUANDO NOSOTROS SÍ ENVIAMOS DATOS AL FORMULARIO
        $equipo = new Equipo();
        var_dump($request->request->all());
        echo "</br>--------DESPUÉS DEL FORM--------</br>";
        $form = $this->createForm('FutbolBundle\Form\EquipoType', $equipo);
        $form->handleRequest($request);
        foreach ($equipo->getEntrenadores() as $key=>$equipoArray){
            echo $equipoArray."</br>" ;           
        }
        echo "</br>---------------------------------</br>";

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($equipo);
            $em->flush($equipo);
            
            return $this->render('@Futbol/Default/index.html.twig');

            //return $this->redirectToRoute('equipo_show', array('id' => $equipo->getId()));
        }

        return $this->render('equipo/new.html.twig', array(
            'equipo' => $equipo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a equipo entity.
     *
     */
    public function showAction(Equipo $equipo)
    {
        $deleteForm = $this->createDeleteForm($equipo);

        return $this->render('equipo/show.html.twig', array(
            'equipo' => $equipo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing equipo entity.
     *
     */
    public function editAction(Request $request, Equipo $equipo)
    {
        $deleteForm = $this->createDeleteForm($equipo);
        $editForm = $this->createForm('FutbolBundle\Form\EquipoType', $equipo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('equipo_edit', array('id' => $equipo->getId()));
        }

        return $this->render('equipo/edit.html.twig', array(
            'equipo' => $equipo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a equipo entity.
     *
     */
    public function deleteAction(Request $request, Equipo $equipo)
    {
        $form = $this->createDeleteForm($equipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($equipo);
            $em->flush();
        }

        return $this->redirectToRoute('equipo_index');
    }

    /**
     * Creates a form to delete a equipo entity.
     *
     * @param Equipo $equipo The equipo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Equipo $equipo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('equipo_delete', array('id' => $equipo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
