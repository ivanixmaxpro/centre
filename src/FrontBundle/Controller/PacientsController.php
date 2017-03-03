<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PacientsController extends Controller
{
	 public function indexAction()
    {
        return $this->render('FrontBundle:Default:index.html.twig');
    }
    public function llistaPacientsAction()
    {
    	$pacients = $this->getDoctrine()->getRepository('FrontBundle:Pacients')->findAll();
        return $this->render('FrontBundle:Default:pacients.html.twig',array('pacients' => $pacients));
    }
}
