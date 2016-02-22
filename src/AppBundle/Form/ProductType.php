<?php

namespace AppBundle\Form;
use Doctrine\ORM\EntityRepository;
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
            ->add('imageLink')
            ->add('poster')
            ->add('brand')
            ->add('weight')
            ->add('productKey')
            ->add('category', 'entity', array(
                'class' => 'AppBundle:Category',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.root', 'ASC')
                        ->addOrderBy('p.lft', 'ASC');
                },
            ))
            ->add('index_widget', 'choice', array(
                'choices' => array(
                    '0' => '无',
                    '1' => '今日推介',
                    '2' => '热卖畅销',
                    '3' => '限时特卖',
                )
            ))
            ->add('widget_weight')
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
