<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Aston\BackBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Aston\BackBundle\Form\Handler\PostHandler;
use Aston\BackBundle\Entity\Post;
/**
 * Description of Post
 *
 * @author dev
 */
class PostController extends Controller{
    
    public function listAction(){
        
        $em=$this->getDoctrine()->getManager();
        $repo=$em->getRepository('AstonBackBundle:Post');
        $posts=$repo->findPosts($this->getUser());
        
        return $this->render('AstonBackBundle:Post:list.html.twig',array('posts'=>$posts)); 
    }
    
    public function addAction(Request $request){
        $form=$this->createForm('Aston\BackBundle\Form\Type\PostType', new Post());
        $em = $this->getDoctrine()->getManager();
        $security=$this->get('security.token_storage');
        $req=$this->get('request_stack');
        
        $handler = new PostHandler($form, $req, $em, $security);
      
        if($handler->process()){
            $this->addFlash('success','Le post a bien été ajouté.');
                return $this->redirect($this->generateUrl('aston_back_blog_list'));
        }
        /* $form->handleRequest($request);
        
        if($form->isSubmitted()){
            if($form->isValid()){
                $em=$this->getDoctrine()->getManager();
                $post=$form->getData();
                $post->setUser($this->getUser());
                
                
                $em->persist($form->getData());
                $em->flush();
                
                $this->addFlash('success','Le post a bien été ajouté.');
                return $this->redirect($this->generateUrl('aston_back_blog_list'));
            }
        }
        */
        return $this->render('AstonBackBundle:Post:form.html.twig', array(
            'form'=>$form->createView(),
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
