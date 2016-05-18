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
            ->add('description')
            ->add('status')
            ->add('poster')
            ->add('imageLink')
            ->add('brand')
            ->add('weight')
            ->add('productKey')
            ->add('click')
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
                    /*'0' => '无',
                    '1' => '今日推荐',
                    '2' => '热卖畅销',
                    '3' => '限时特卖',
                    '4' => '折扣商品',
                    '5' => '人气商品',*/
                    '0' => '无',
                    '1' => '今日推荐',
                    '2' => '热卖畅销',
                    '3' => '新货上架',
                    '4' => '限时特卖',
                    '5' => '折扣商品',
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
