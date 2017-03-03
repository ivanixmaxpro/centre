<?php

namespace BackBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FrontBundle\Entity\Visites;
use FrontBundle\Entity\Pacients;
use FrontBundle\Entity\Metges;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class VisitesController extends Controller {

    public function llistaVisitesAction() {
        $visites = $this->getDoctrine()->getRepository('FrontBundle:Visites')->findAll();
        return $this->render('BackBundle:Default:visites.html.twig', array('visites' => $visites));
    }

    public function newAction(Request $request) {
        // crea una categoria y le asigna algunos datos ficticios para este ejemplo
        $visites = new Visites();

        $em = $this->getDoctrine()->getEntityManager();
        $form = $this->createFormBuilder()
                ->add('data', DateType::class, array('label' => 'Data'))
                ->add('tractamentsFk', ChoiceType::class, array('label' => 'Tractament',
                    'choices' => array(
                        'Tractament' => $this->getDoctrine()->getRepository('FrontBundle:Tractaments')->findOneBy(array('tipus' => 'tractament')),
                        'Concertada' => $this->getDoctrine()->getRepository('FrontBundle:Tractaments')->findOneBy(array('tipus' => 'concertada')),
                        'Urgencia' => $this->getDoctrine()->getRepository('FrontBundle:Tractaments')->findOneBy(array('tipus' => 'urgencia')
                ))))
                ->add('metgesFk', TextType::class, array('label' => 'DNI Metge'))
                ->add('pacientsFk', TextType::class, array('label' => 'DNI Pacient'))
                ->add('save', SubmitType::class, array('label' => 'Afegir visita'))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated

            $visites->setData($form->get('data')->getData());
            $visites->setTractamentsFk($form->get('tractamentsFk')->getData());


            // metges
            $dniM = $form->get('metgesFk')->getData();
            $metges = $em->getRepository('FrontBundle:Metges');
            $metge = $metges->findOneBy(array('dni' => $dniM));
            $visites->setMetgesFk($metge);

            //pacients
            $dniP = $form->get('pacientsFk')->getData();
            $pacients = $em->getRepository('FrontBundle:Pacients');
            $pacient = $pacients->findOneBy(array('dni' => $dniP));
            $visites->setPacientsFk($pacient);

            //$visites = $form->getData();
            // ... perform some action, such as saving the task to the database
            // for example, if Category is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($visites);
            $em->flush();
            return $this->redirectToRoute('centre_medic_llista_back_visites');
        }

        return $this->render('BackBundle:Default:addPacient.html.twig', array(
                    'titol' => 'Afegir Pacient',
                    'form' => $form->createView(),
        ));
    }

    // usar para mostrar la infd de algo en concreto
    public function viewAction($id) {
        $this->getDoctrine()->getRepository('BackBundle:Visites')->find($id);
        return $this->render('BackBundle:visites:view.html.twig', array('prueba' => $prueba));
    }

    // me he quedadoa aqui
    public function editAction($id, Request $req) {
        // crea una categoria y le asigna algunos datos ficticios para este ejemplo

        $visites = $this->getDoctrine()->getRepository('FrontBundle:Visites')->find($id);
        $form = $this->createFormBuilder()
                ->add('data', DateType::class, array('label' => 'Data' ,'data' => $visites->getData()))
                ->add('tractamentsFk', ChoiceType::class, array('label' => 'Tractament',
                    'choices' => array(
                        'Tractament' => $this->getDoctrine()->getRepository('FrontBundle:Tractaments')->findOneBy(array('tipus' => 'tractament')),
                        'Concertada' => $this->getDoctrine()->getRepository('FrontBundle:Tractaments')->findOneBy(array('tipus' => 'concertada')),
                        'Urgencia' => $this->getDoctrine()->getRepository('FrontBundle:Tractaments')->findOneBy(array('tipus' => 'urgencia'))
            ), 'data' => $visites->getTractamentsFk()))
                ->add('metgesFk', TextType::class, array('label' => 'DNI Metge', 'data' => $visites->getMetgesFk()->getDni()))
                ->add('pacientsFk', TextType::class, array('label' => 'DNI Pacient', 'data' => $visites->getPacientsFk()->getDni()))
                ->add('save', SubmitType::class, array('label' => 'Afegir visita'))
                ->getForm();

        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated

            $visites = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Category is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($visites);
            $em->flush();
            return $this->redirectToRoute('centre_medic_llista_back_visites');
        }

        return $this->render('BackBundle:Default:addVisita.html.twig', array(
                    'titol' => 'Modificar Visita',
                    'form' => $form->createView(),
        ));
    }

    public function deleteAction($dni) {
        $visites = $this->getDoctrine()->getRepository('FrontBundle:Visites')->find($dni);
        $em = $this->getDoctrine()->getManager();
        $em->remove($visites);
        $em->flush();
        return $this->redirectToRoute('centre_medic_llista_back_visites');
    }

}
