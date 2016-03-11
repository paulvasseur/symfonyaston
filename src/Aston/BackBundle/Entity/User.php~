<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Aston\BackBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Description of User
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 */
class User extends BaseUser {
    /**
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     */
    protected $id;
    
    
    /**
     *
     * @var array Post
     * @ORM\OneToMany(targetEntity="Post", mappedBy="user")
     */
    protected $posts;
    
   
}
