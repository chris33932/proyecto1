<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Oferta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Ofertum controller.
 *
 * @Route("oferta")
 */
class OfertaController extends Controller
{
    /**
     * Lists all ofertum entities.
     *
     * @Route("/", name="oferta_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ofertas = $em->getRepository('AppBundle:Oferta')->findAll();

        return $this->render('oferta/index.html.twig', array(
            'ofertas' => $ofertas,
        ));
    }

    /**
     * Creates a new ofertum entity.
     *
     * @Route("/new", name="oferta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ofertum = new Ofertum();
        $form = $this->createForm('AppBundle\Form\OfertaType', $ofertum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ofertum);
            $em->flush();

            return $this->redirectToRoute('oferta_show', array('id' => $ofertum->getId()));
        }

        return $this->render('oferta/new.html.twig', array(
            'ofertum' => $ofertum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ofertum entity.
     *
     * @Route("/{id}", name="oferta_show")
     * @Method("GET")
     */
    public function showAction(Oferta $ofertum)
    {
        $deleteForm = $this->createDeleteForm($ofertum);

        return $this->render('oferta/show.html.twig', array(
            'ofertum' => $ofertum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ofertum entity.
     *
     * @Route("/{id}/edit", name="oferta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Oferta $ofertum)
    {
        $deleteForm = $this->createDeleteForm($ofertum);
        $editForm = $this->createForm('AppBundle\Form\OfertaType', $ofertum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('oferta_edit', array('id' => $ofertum->getId()));
        }

        return $this->render('oferta/edit.html.twig', array(
            'ofertum' => $ofertum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ofertum entity.
     *
     * @Route("/{id}", name="oferta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Oferta $ofertum)
    {
        $form = $this->createDeleteForm($ofertum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ofertum);
            $em->flush();
        }

        return $this->redirectToRoute('oferta_index');
    }

    /**
     * Creates a form to delete a ofertum entity.
     *
     * @param Oferta $ofertum The ofertum entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Oferta $ofertum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('oferta_delete', array('id' => $ofertum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
