<?php

namespace PruebaBundle\Controller;

use PruebaBundle\Entity\Categorias;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Categoria controller.
 *
 */
class CategoriasController extends Controller
{
    /**
     * Lists all categoria entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorias = $em->getRepository('PruebaBundle:Categorias')->findAll();

        return $this->render('categorias/index.html.twig', array(
            'categorias' => $categorias,
        ));
    }

    /**
     * Creates a new categoria entity.
     *
     */
    public function newAction(Request $request)
    {
        $categoria = new Categorias();
        $form = $this->createForm('PruebaBundle\Form\CategoriasType', $categoria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoria);
            $em->flush();

            return $this->redirectToRoute('categorias_show', array('id' => $categoria->getId()));
        }

        return $this->render('categorias/new.html.twig', array(
            'categoria' => $categoria,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categoria entity.
     *
     */
    public function showAction(Categorias $categoria)
    {
        $deleteForm = $this->createDeleteForm($categoria);

        return $this->render('categorias/show.html.twig', array(
            'categoria' => $categoria,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categoria entity.
     *
     */
    public function editAction(Request $request, Categorias $categoria)
    {
        $deleteForm = $this->createDeleteForm($categoria);
        $editForm = $this->createForm('PruebaBundle\Form\CategoriasType', $categoria);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorias_edit', array('id' => $categoria->getId()));
        }

        return $this->render('categorias/edit.html.twig', array(
            'categoria' => $categoria,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categoria entity.
     *
     */
    public function deleteAction(Request $request, Categorias $categoria)
    {
        $form = $this->createDeleteForm($categoria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categoria);
            $em->flush();
        }

        return $this->redirectToRoute('categorias_index');
    }

    /**
     * Creates a form to delete a categoria entity.
     *
     * @param Categorias $categoria The categoria entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Categorias $categoria)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categorias_delete', array('id' => $categoria->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
