<?php

namespace Aston\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AstonFrontBundle:Default:index.html.twig');
    }
    
    public function helloAction($name){
        return $this->render('AstonFrontBundle:Default:hello.html.twig',array('prenom'=>$name));
       
    }
    
    public function aboutAction(){
        return $this->render('AstonFrontBundle:Default:about.html.twig');
       
    }
    
    public function postAction(){
        return $this->render('AstonFrontBundle:Default:post.html.twig');
       
    }
    
    public function contactAction(){
        return $this->render('AstonFrontBundle:Default:contact.html.twig');
       
    }
}
