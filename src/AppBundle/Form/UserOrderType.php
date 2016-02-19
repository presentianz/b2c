<?php

    namespace AppBundle\Form;

    use Doctrine\ORM\EntityRepository;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolverInterface;

    class UserOrderType extends AbstractType
    {
        /**
         * @param FormBuilderInterface $builder
         * @param array $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder->add('orderId')->add('status', 'choice', array(
                'attr' => array('placeholder' => '请选择收货地区'),
                'choices' => array(
                    '0' => '未付款',
                    '1' => '待发货',
                    '2' => '已发货',
                    '3' => '已收货',
                    '4' => '已取消',
                ),
                'required' => true
            ))->add('total_price')->add('post_fee')->add('create_at', 'datetime')->add('paid_at', 'datetime')->add('user')->add('shipmentAddress');
        }

        /**
         * @param OptionsResolverInterface $resolver
         */
        public function setDefaultOptions(OptionsResolverInterface $resolver)
        {
            $resolver->setDefaults(array(
                'data_class' => 'AppBundle\Entity\UserOrder'
            ));
        }

        /**
         * @return string
         */
        public function getName()
        {
            return 'appbundle_order';
        }
    }
