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
 * Description of Categorie
 *
 * @author dev
 */
class CategorieController extends Controller{
    
    public function listAction(){
                
        $em=$this->getDoctrine()->getManager();
        $repo=$em->getRepository('AstonBackBundle:Categorie');
        $cat=$repo->findAll();
        
        return $this->render('AstonBackBundle:Categorie:categorieList.html.twig',array('categorie'=>$cat)); 
    }
    
    public function addAction(Request $request){
        
        $em=$this->getDoctrine()->getManager();
        $repo = $em->getRepository('AstonBackBundle:Categorie');
        
        
        $form=$this->createForm('Aston\BackBundle\Form\Type\CategorieType', new \Aston\BackBundle\Entity\Categorie());
        $form->handleRequest($request);
        
        if($form->isSubmitted()){
            if($form->isValid()){
                $em->persist($form->getData()); 
                $em->flush();
                
                $this->addFlash('success','Le post a bien été ajouté.');
                return $this->redirect($this->generateUrl('aston_back_categorie_list'));
            }
        }
        
        return $this->render('AstonBackBundle:Categorie:categorieAdd.html.twig', array(
            'form'=>$form->createView(),
        )); 
    }
    
    public function updateAction(Request $request){
        //throw $this->createNotFoundException('Categorie not found');
        $id= (int) $request->get('id');
        $em=$this->getDoctrine()->getManager();
        $repo = $em->getRepository('AstonBackBundle:Categorie');
      
        
        $form=$this->createForm('Aston\BackBundle\Form\Type\CategorieType', $repo->find($id));
        $form->handleRequest($request);
        
        if($form->isSubmitted()){
            if($form->isValid()){
                 
                $em->flush();
                
                $this->addFlash('success','La catégorie a bien été modifiée.');
                return $this->redirect($this->generateUrl('aston_back_categorie_list'));
            }
        }
        
        return $this->render('AstonBackBundle:Categorie:categorieAdd.html.twig', array(
            'form'=>$form->createView(),
        ));  
    }
    
    public function deleteAction(Request $request){
      
         $id= (int) $request->get('id');    
        $em=$this->getDoctrine()->getManager();
        $repo = $em->getRepository('AstonBackBundle:Categorie');
        $post = $repo->find($id);
        $em->remove($post);
        $em->flush();
        return $this->redirect($this->generateUrl('aston_back_categorie_list'));
    }
    
   

    
}
