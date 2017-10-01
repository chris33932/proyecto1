<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ciudad;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Ciudad controller.
 *
 * @Route("ciudad")
 */
class CiudadController extends Controller
{
    /**
     * Lists all ciudad entities.
     *
     * @Route("/", name="ciudad_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ciudads = $em->getRepository('AppBundle:Ciudad')->findAll();

        return $this->render('ciudad/index.html.twig', array(
            'ciudads' => $ciudads,
        ));
    }

    /**
     * Creates a new ciudad entity.
     *
     * @Route("/new", name="ciudad_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ciudad = new Ciudad();
        $form = $this->createForm('AppBundle\Form\CiudadType', $ciudad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ciudad);
            $em->flush();

            return $this->redirectToRoute('ciudad_show', array('id' => $ciudad->getId()));
        }

        return $this->render('ciudad/new.html.twig', array(
            'ciudad' => $ciudad,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ciudad entity.
     *
     * @Route("/{id}", name="ciudad_show")
     * @Method("GET")
     */
    public function showAction(Ciudad $ciudad)
    {
        $deleteForm = $this->createDeleteForm($ciudad);

        return $this->render('ciudad/show.html.twig', array(
            'ciudad' => $ciudad,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ciudad entity.
     *
     * @Route("/{id}/edit", name="ciudad_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Ciudad $ciudad)
    {
        $deleteForm = $this->createDeleteForm($ciudad);
        $editForm = $this->createForm('AppBundle\Form\CiudadType', $ciudad);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ciudad_edit', array('id' => $ciudad->getId()));
        }

        return $this->render('ciudad/edit.html.twig', array(
            'ciudad' => $ciudad,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ciudad entity.
     *
     * @Route("/{id}", name="ciudad_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Ciudad $ciudad)
    {
        $form = $this->createDeleteForm($ciudad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ciudad);
            $em->flush();
        }

        return $this->redirectToRoute('ciudad_index');
    }

    /**
     * Creates a form to delete a ciudad entity.
     *
     * @param Ciudad $ciudad The ciudad entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ciudad $ciudad)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ciudad_delete', array('id' => $ciudad->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
