<?php

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FrontBundle\Entity\Pacients;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PacientsController extends Controller {

    public function indexAction() {
        return $this->render('BackBundle:Default:index.html.twig');
    }

    public function llistaPacientsAction() {
        $pacients = $this->getDoctrine()->getRepository('FrontBundle:Pacients')->findAll();
        return $this->render('BackBundle:Default:pacients.html.twig', array('pacients' => $pacients));
    }

    public function newAction(Request $request) {
        // crea una categoria y le asigna algunos datos ficticios para este ejemplo
        $pacients = new Pacients();
        // $category->setName('tato');

        $form = $this->createFormBuilder($pacients)
                ->add('dni', TextType::class, array('label' => 'DNI'))
                ->add('nom', TextType::class, array('label' => 'Nom'))
                ->add('cognom', TextType::class, array('label' => 'Cognom'))
                ->add('dolencia', TextType::class, array('label' => 'Dolencia'))
                ->add('save', SubmitType::class, array('label' => 'Afegir pacient'))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated

            $pacients = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Category is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($pacients);
            $em->flush();
            return $this->redirectToRoute('centre_medic_llista_back_pacients');
        }

        return $this->render('BackBundle:Default:addPacient.html.twig', array(
                    'titol' => 'Afegir Pacient',
                    'form' => $form->createView(),
        ));
    }

    // usar para mostrar la infd de algo en concreto
    public function viewAction($dni) {
        $this->getDoctrine()->getRepository('BackBundle:Pacients')->find($dni);
        return $this->render('BackBundle:Pacients:view.html.twig', array('prueba' => $prueba));
    }

    public function editAction($dni, Request $req) {
        // crea una categoria y le asigna algunos datos ficticios para este ejemplo

        $pacients = $this->getDoctrine()->getRepository('FrontBundle:Pacients')->find($dni);
        $form = $this->createFormBuilder($pacients)
                ->add('dni', TextType::class, array('label' => 'DNI', 'data' => $pacients->getDni()))
                ->add('nom', TextType::class, array('label' => 'Nom', 'data' => $pacients->getNom()))
                ->add('cognom', TextType::class, array('label' => 'Cognom', 'data' => $pacients->getCognom()))
                ->add('dolencia', TextType::class, array('label' => 'Dolencia', 'data' => $pacients->getDolencia()))
                ->add('save', SubmitType::class, array('label' => 'Modificar Pacient'))
                ->getForm();

        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated

            $pacients = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Category is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($pacients);
            $em->flush();
            return $this->redirectToRoute('centre_medic_llista_back_pacients');
        }

        return $this->render('BackBundle:Default:addPacient.html.twig', array(
                    'titol' => 'Afegir Pacient',
                    'form' => $form->createView(),
        ));
    }

    public function deleteAction($dni) {
        $pacient = $this->getDoctrine()->getRepository('FrontBundle:Pacients')->find($dni);
        $em = $this->getDoctrine()->getManager();
        $em->remove($pacient);
        $em->flush();
        return $this->redirectToRoute('centre_medic_llista_back_pacients');
    }

}
