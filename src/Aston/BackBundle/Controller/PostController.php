<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Aston\BackBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of Post
 *
 * @author dev
 */
class PostController extends Controller{
    
    public function listAction(){
                $service=$this->get('aston_back.greeting');
        
        \Symfony\Component\VarDumper\VarDumper::dump($service->sayHello());
        $em=$this->getDoctrine()->getManager();
        $repo=$em->getRepository('AstonBackBundle:Post');
        $posts=$repo->findPosts($this->getUser());
        
        return $this->render('AstonBackBundle:Post:list.html.twig',array('posts'=>$posts)); 
    }
    
    public function addAction(Request $request){
        $handler=$this->get('back.form.handler.form');
      
        if($handler->process()){
            $this->addFlash('success','Le post a bien été ajouté.');
                return $this->redirect($this->generateUrl('aston_back_blog_list'));
        }
     
        return $this->render('AstonBackBundle:Post:form.html.twig', array(
            'form'=>$handler->getForm()->createView(),
        ));
    }
    
    public function updateAction(Request $request){
        //throw $this->createNotFoundException('Post not found');
        $id= (int) $request->get('id');
        $em=$this->getDoctrine()->getManager();
        $repo = $em->getRepository('AstonBackBundle:Post');
        $post = $repo->find($id);
        
        $form=$this->createForm('Aston\BackBundle\Form\Type\PostType', $post);
        $form->handleRequest($request);
        
        if($form->isSubmitted()){
            if($form->isValid()){
                 
                $em->flush();
                
                $this->addFlash('success','Le post a bien été ajouté.');
                return $this->redirect($this->generateUrl('aston_back_blog_list'));
            }
        }
        
        return $this->render('AstonBackBundle:Post:form.html.twig', array(
            'form'=>$form->createView(),
        ));  
    }
    
    public function deleteAction(Request $request){
      
         $id= (int) $request->get('id');    
        $em=$this->getDoctrine()->getManager();
        $repo = $em->getRepository('AstonBackBundle:Post');
        $post = $repo->find($id);
        $em->remove($post);
        $em->flush();
        return $this->redirect($this->generateUrl('aston_back_blog_list'));
    }
    
   

    
}
