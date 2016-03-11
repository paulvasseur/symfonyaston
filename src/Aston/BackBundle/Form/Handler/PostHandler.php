<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Aston\BackBundle\Form\Handler;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
/**
 * Description of PostHandler
 *
 * @author dev
 */
class PostHandler {
    protected $em;
    protected $form;    
    protected $request;
    protected $security;
    
    public function __construct(Form $form, RequestStack $req, ObjectManager $objectManager, TokenStorageInterface $security) {
        $this->form = $form;
        $this->request=$req->getCurrentRequest();
        $this->em=$objectManager;
        $this->security=$security;
    }
    
    public function process(){
        if($this->request->isMethod('POST')){
            $this->form->handleRequest($this->request->getCurrentRequest());
            if($this->form->isValid()){
                $this->onSuccess();
                return true;
            }
        }
        return false;
    }
    
    public function onSuccess(){
        $post =$this->form->getData();
        $post->setUser($this->security->getToken()->getUser());
        
        $this->em->persist($post);
        $this->em->flush();
    }
}
