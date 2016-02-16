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
        			
			    	->add('country', 'choice', array(
	            		'label' => '*收货地区', 
                        'attr' => array('placeholder' => '请选择收货地区'),
	            		'choices' => array('中国' => '中国', 
                                           '新西兰' => '新西兰'),   
                    'required' => true                                                  
            		))
			    	->add('region','choice',array(
                        'attr' => array( 'placeholder' => '请选择收货省份'),
                        'choices' => array('北京市' => '北京市', '天津市' => '天津市', '上海市' => '上海市', '重庆市' => '重庆市', 
                                           '河北省' => '河北省', '山西省' => '山西省', '内蒙古省' => '内蒙古省', '辽宁省' => '辽宁省', 
                                           '吉林省' => '吉林省', '黑龙江省' => '黑龙江省', '江苏省' => '江苏省', '浙江省' => '浙江省', 
                                           '安徽省' => '安徽省', '福建省' => '福建省', '江西省' => '江西省', '山东省' => '山东省', 
                                           '河南省' => '河南省', '湖北省' => '湖北省', '湖南省' => '湖南省', '广东省' => '广东省', 
                                           '广西省' => '广西省', '海南省' => '海南省', '四川省' => '四川省', '贵州省' => '贵州省', 
                                           '云南省' => '云南省', '西藏省' => '西藏省', '陕西省' => '陕西省', '甘肃省' => '甘肃省', 
                                           '青海省' => '青海省', '宁夏省' => '宁夏省', '新疆省' => '新疆省', '台湾' => '台湾', 
                                           '香港' => '香港', '澳门' => '澳门','海外' => '海外'),
                        'required' => true
                    ))
			    	->add('city','text',array('label'=>'城市',
                          'required' => false,
                          'empty_data' => ' ',))
                    ->add('post_code','text',array('label'=>'邮编:',
                         'required' => false,
                         'empty_data' => ' ',))
                    ->add('address','textarea',array('label'=>'*收货地址：',
                          'required' => true
                      ))
			    	

                    ->add('name','text',array(
                        'label'=>'*收件人姓名:',
                        'attr' => array('placeholder' => '必须是中文'),
                       'required' => true
                        ))
                    ->add('phone_no','text',array(
                        'label'=>'*收件人手机号码：',
                        'attr' => array('placeholder' => '可以直接填写',),
                        'required' => false,
                        'empty_data' => ' ',
                        ))
                    ->add('contact_no','text',array(
                        'label'=>'*固定电话：',
                       'attr' => array( 'placeholder' => '（区号）-电话号码',
                        'pattern' => '[\(]?\d+[\)]?\s*\d+\s*[\-]?\d+'),
                       'required' => true
                        ))
                    ->add('id_no','text',array(
                        'label'=>'收件人身份证号码：',
                        'required' => false,
                        'empty_data' => ' ',
                       'attr' => array( 'placeholder' => '收货地区为中国需要填写'),
                        ))

                    ->add('img1','file',array(
                        'label'=>'身份证正面：', 
                        'required' => false))
                    ->add('img2','file',array(
                        'label'=>'身份证背面：', 
                        'required' => false))
                    ->add('comment','textarea',array(
                        'label'=>'订单附言：',
                        'attr' => array('placeholder' => '有什么需要请吩咐哦'),
                        'empty_data' => '没有留言',
                        'required' => false
                        ));
			    	

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
