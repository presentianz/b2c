<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ShipmentAddressFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        			->add('name','text',array('label'=>'联系人'))
			    	->add('contact_no','text',array('label'=>'联系电话'))
			    	->add('id_no','text',array('label'=>'证件号码'))
			    	->add('id_scans','text',array('label'=>'证件扫描'))
			    	->add('contact_no','text',array('label'=>'联系电话'))
			    	->add('country', 'choice', array(
	            		'label' => '国家', 
	            		'placeholder' => '--',
	            		'choices' => array('中国' => '中国', '新西兰' => '新西兰'),
            		))
			    	->add('region','text',array('label'=>'省份/地区'))
			    	->add('city','text',array('label'=>'城市'))
			    	->add('post_code','text',array('label'=>'邮编'))
			    	->add('address','textarea',array('label'=>'详细地址'))
			    	->add('save', 'submit', array('label' => '提交'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ShipmentAddress',
        ));
    }

    // BC for SF < 2.7
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    public function getName()
    {
        return 'shipment_address';
    }
}
