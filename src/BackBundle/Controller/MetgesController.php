<?php

namespace BackBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FrontBundle\Entity\Metges;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MetgesController extends Controller {

    public function llistaMetgesAction() {
        $metges = $this->getDoctrine()->getRepository('FrontBundle:Metges')->findAll();
        return $this->render('BackBundle:Default:metges.html.twig', array('metges' => $metges));
    }

    public function newAction(Request $request) {
        // crea una categoria y le asigna algunos datos ficticios para este ejemplo
        $metges = new Metges();
        // $category->setName('tato');

        $form = $this->createFormBuilder($metges)
                ->add('dni', TextType::class, array('label' => 'DNI'))
                ->add('nom', TextType::class, array('label' => 'Nom'))
                ->add('cognom', TextType::class, array('label' => 'Cognom'))
                ->add('especialitat', TextType::class, array('label' => 'Especialitat'))
                ->add('save', SubmitType::class, array('label' => 'Afegir Metge'))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated

            $metges = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Category is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($matges);
            $em->flush();
            return $this->redirectToRoute('centre_medic_llista_back_metges');
        }

        return $this->render('BackBundle:Default:addMetge.html.twig', array(
                    'titol' => 'Afegir Metge',
                    'form' => $form->createView(),
        ));
    }

    // usar para mostrar la infd de algo en concreto
    public function viewAction($dni) {
        $this->getDoctrine()->getRepository('BackBundle:Metges')->find($dni);
        return $this->render('BackBundle:Metges:view.html.twig', array('prueba' => $prueba));
    }

    public function editAction($dni, Request $req) {
        // crea una categoria y le asigna algunos datos ficticios para este ejemplo

        $metges = $this->getDoctrine()->getRepository('FrontBundle:Metges')->find($dni);
        $form = $this->createFormBuilder($metges)
                ->add('dni', TextType::class, array('label' => 'DNI', 'data' => $metges->getDni()))
                ->add('nom', TextType::class, array('label' => 'Nom', 'data' => $metges->getNom()))
                ->add('cognom', TextType::class, array('label' => 'Cognom', 'data' => $metges->getCognom()))
                ->add('especialitat', TextType::class, array('label' => 'Especialitat', 'data' => $metges->getEspecialitat()))
                ->add('save', SubmitType::class, array('label' => 'Modificar Metge'))
                ->getForm();

        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated

            $metges = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Category is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($metges);
            $em->flush();
            return $this->redirectToRoute('centre_medic_llista_back_metges');
        }

        return $this->render('BackBundle:Default:addMetges.html.twig', array(
                    'titol' => 'Afegir Metge',
                    'form' => $form->createView(),
        ));
    }

    public function deleteAction($dni) {
        $metges = $this->getDoctrine()->getRepository('FrontBundle:Metges')->find($dni);
        $em = $this->getDoctrine()->getManager();
        $em->remove($metges);
        $em->flush();
        return $this->redirectToRoute('centre_medic_llista_back_metges');
    }

}
