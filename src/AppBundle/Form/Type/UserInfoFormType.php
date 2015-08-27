<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class UserInfoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullname', 'text', array('label' => 'profile.fullname', 'translation_domain' => 'FOSUserBundle','required' => true))
            ->add('wechatno', 'text', array('label' => 'profile.wechatno', 'translation_domain' => 'FOSUserBundle'))
            ->add('qqno', 'text', array('label' => 'profile.qqno', 'translation_domain' => 'FOSUserBundle'))
            ->add('contactno', 'text', array('label' => 'profile.contactno', 'translation_domain' => 'FOSUserBundle','required' => true))
            ->add('country', 'choice', array(
            		'label' => 'profile.country', 
            		'translation_domain' => 'FOSUserBundle',
            		'placeholder' => '--',
            		'choices' => array('中国' => '中国', '新西兰' => '新西兰'),
            ))
            ->add('region', 'text', array('label' => 'profile.region', 'translation_domain' => 'FOSUserBundle'))
            ->add('city', 'text', array('label' => 'profile.city', 'translation_domain' => 'FOSUserBundle'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\UserInfo',
        ));
    }

    // BC for SF < 2.7
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    public function getName()
    {
        return 'userinfo';
    }
}
