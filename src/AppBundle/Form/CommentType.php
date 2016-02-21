<?php

    namespace AppBundle\Form;
    use Doctrine\ORM\EntityRepository;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolverInterface;

    class CommentType extends AbstractType
    {
        /**
         * @param FormBuilderInterface $builder
         * @param array $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('text','textarea',array(
                        'attr' => array('placeholder' => '请填写你的评论'),
                        'required' => false
                        ))
                ->add('reply','text',array(
                    'required' => false
                ))
                ->add('star','text',array(
                    'required' => false
                ))
                ->add('commentAt')
                ->add('product')
                ->add('user')
            ;
        }

        /**
         * @param OptionsResolverInterface $resolver
         */
        public function setDefaultOptions(OptionsResolverInterface $resolver)
        {
            $resolver->setDefaults(array(
                'data_class' => 'AppBundle\Entity\Comment'
            ));
        }

        /**
         * @return string
         */
        public function getName()
        {
            return 'appbundle_comment';
        }
    }
