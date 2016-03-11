<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Aston\BackBundle\Service;
/**
 * Description of Greeting
 *
 * @author dev
 */
class Greeting {
    private $name;
    
    public function __construct(string $name) {
        $this->name=$name;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function sayHello(){
        return 'Hello'.$this->getName();
    }
}
