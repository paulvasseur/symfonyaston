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
                ->add('name',null,array('label'=>'app.name'))
                ->add('email', \Symfony\Component\Form\Extension\Core\Type\EmailType::class)
                ->add('phone',null,array('label'=>'app.phone'))
                ->add('message', \Symfony\Component\Form\Extension\Core\Type\TextareaType::class)
                ->add('send',  \Symfony\Component\Form\Extension\Core\Type\SubmitType::class)    
                ->getForm();        
        //validation formulaire
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
           $em=$this->getDoctrine()->getManager();
           $em->persist($form->getData());
           $em->flush();
           
           $this->get('session')->getFlashBag()->add('success','Bravo, votre message a été envoyé !!!');
           
           return $this->redirectToRoute("aston_front_hello");
        }
        
        
        return $this->render('AstonFrontBundle:Default:contact.html.twig',array('form'=>$form->createView(),));
       
    }
    
    public function sessionWriteAction(){
        $session=$this->get('session');
        $session->set('name','Sf3');
        return new \Symfony\Component\HttpFoundation\Response('Writing...');
    }
    
    public function sessionReadAction(){
        $session=$this->get('session');
        $name=$session->get('name');
        
        return new \Symfony\Component\HttpFoundation\Response ("Reading... $name");

    }
}
