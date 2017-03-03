<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MetgesController extends Controller
{
    
     public function llistaMetgesAction()
    {
    	$metges = $this->getDoctrine()->getRepository('FrontBundle:Metges')->findAll();
        return $this->render('FrontBundle:Default:metges.html.twig',array('metges' => $metges));
    }
}
