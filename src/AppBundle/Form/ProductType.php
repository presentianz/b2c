<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('price_discounted')
            ->add('viewed_count')
            ->add('soldNo')
            ->add('inventory')
            ->add('click')
            ->add('description')
            ->add('status')
            ->add('updateAt')
            ->add('poster')
            ->add('imageLink')
            ->add('brand')
            ->add('weight')
            ->add('productKey')
            ->add('category')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Product'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_product';
    }
}
