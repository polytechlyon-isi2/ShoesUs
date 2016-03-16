<?php

namespace ShoesUs\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('desc', 'textarea')
            ->add('price', 'number');
    }

    public function getName()
    {
        return 'product';
    }
}