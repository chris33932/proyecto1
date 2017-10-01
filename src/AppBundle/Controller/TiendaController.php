<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tienda;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Tienda controller.
 *
 * @Route("tienda")
 */
class TiendaController extends Controller
{
    /**
     * Lists all tienda entities.
     *
     * @Route("/", name="tienda_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tiendas = $em->getRepository('AppBundle:Tienda')->findAll();

        return $this->render('tienda/index.html.twig', array(
            'tiendas' => $tiendas,
        ));
    }

    /**
     * Creates a new tienda entity.
     *
     * @Route("/new", name="tienda_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tienda = new Tienda();
        $form = $this->createForm('AppBundle\Form\TiendaType', $tienda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tienda);
            $em->flush();

            return $this->redirectToRoute('tienda_show', array('id' => $tienda->getId()));
        }

        return $this->render('tienda/new.html.twig', array(
            'tienda' => $tienda,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tienda entity.
     *
     * @Route("/{id}", name="tienda_show")
     * @Method("GET")
     */
    public function showAction(Tienda $tienda)
    {
        $deleteForm = $this->createDeleteForm($tienda);

        return $this->render('tienda/show.html.twig', array(
            'tienda' => $tienda,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tienda entity.
     *
     * @Route("/{id}/edit", name="tienda_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tienda $tienda)
    {
        $deleteForm = $this->createDeleteForm($tienda);
        $editForm = $this->createForm('AppBundle\Form\TiendaType', $tienda);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tienda_edit', array('id' => $tienda->getId()));
        }

        return $this->render('tienda/edit.html.twig', array(
            'tienda' => $tienda,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tienda entity.
     *
     * @Route("/{id}", name="tienda_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tienda $tienda)
    {
        $form = $this->createDeleteForm($tienda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tienda);
            $em->flush();
        }

        return $this->redirectToRoute('tienda_index');
    }

    /**
     * Creates a form to delete a tienda entity.
     *
     * @param Tienda $tienda The tienda entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tienda $tienda)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tienda_delete', array('id' => $tienda->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
