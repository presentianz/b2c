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
            ->add('fullname', 'text', array('label' => '姓名', 'translation_domain' => 'FOSUserBundle','required' => true))
            ->add('wechatno', 'text', array('label' => '微信', 'translation_domain' => 'FOSUserBundle'))
            ->add('qqno', 'text', array('label' => 'QQ号', 'translation_domain' => 'FOSUserBundle'))
            ->add('contactno', 'text', array('label' => '联系电话', 'translation_domain' => 'FOSUserBundle','required' => true))
            ->add('birthday', 'text', array('label' => '出生日期', 'translation_domain' => 'FOSUserBundle'))
            ->add('country', 'choice', array(
            		'label' => '国家',
            		'translation_domain' => 'FOSUserBundle',
            		'placeholder' => '--',
            		'choices' => array('中国' => '中国', '新西兰' => '新西兰'),
            ))
            ->add('region', 'text', array('label' => '省份', 'translation_domain' => 'FOSUserBundle'))
            ->add('city', 'text', array('label' => '城市', 'translation_domain' => 'FOSUserBundle'))
            ->add('exp', 'text', array('label' => '经验', 'translation_domain' => 'FOSUserBundle'))
            ->add('points', 'text', array('label' => '积分', 'translation_domain' => 'FOSUserBundle'))
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
