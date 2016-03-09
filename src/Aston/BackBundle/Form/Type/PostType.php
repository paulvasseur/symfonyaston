<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Aston\Backbundle\Form\Type;

use Symfony\Component\Form\AbstractType;
/**
 * Description of PostType
 *
 * @author dev
 */
class PostType extends AbstractType {
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options) {
        $builder->add('title')
                ->add('teaser')
                ->add('content')
                ->add('publish', null, ['required'=>false])
                ->add('creatDate')
                ->add('title',  \Symfony\Component\Form\Extension\Core\Type\SubmitType::class);
                
    }

    public function getName(){
        return 'post_form';
    }

}
