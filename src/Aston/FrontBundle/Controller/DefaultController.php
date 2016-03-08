<?php

namespace Aston\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Aston\FrontBundle\Entity\Contact;

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
    
    public function contactAction(Request $request){
        //déclaration formulaire
        $form= $this->createFormBuilder(new Contact)
                ->add('name')
                ->add('email', \Symfony\Component\Form\Extension\Core\Type\EmailType::class)
                ->add('phone')
                ->add('message', \Symfony\Component\Form\Extension\Core\Type\TextareaType::class)
                ->add('send',  \Symfony\Component\Form\Extension\Core\Type\SubmitType::class)    
                ->getForm();        
        //validation formulaire
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            \Symfony\Component\VarDumper\VarDumper::dump($form->getErrors(true, true));
        }
        
        
        return $this->render('AstonFrontBundle:Default:contact.html.twig',array('form'=>$form->createView(),));
       
    }
}
