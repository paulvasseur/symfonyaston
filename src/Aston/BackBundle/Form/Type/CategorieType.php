<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Aston\BackBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
/**
 * Description of CategorieType
 *
 * @author dev
 */
class CategorieType extends AbstractType {
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options) {
        $builder->add('name')
                ->add('send',  \Symfony\Component\Form\Extension\Core\Type\SubmitType::class);
                
    }

    public function getName(){
        return 'categorie_form';
    }

}
