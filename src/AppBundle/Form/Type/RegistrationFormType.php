// <?php
// namespace AppBundle\Form\Type;

// use Symfony\Component\Form\AbstractType;
// use Symfony\Component\Form\FormBuilderInterface;
// use Symfony\Component\OptionsResolver\OptionsResolver;
// use Symfony\Component\OptionsResolver\OptionsResolverInterface;
// use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;


// class RegistrationFormType extends AbstractType
// {
//     private $class;
//     /**
//      * @param string $class The User class name
//      */
//     public function __construct($class)
//     {
//         $this->class = $class;
//     }
//     public function buildForm(FormBuilderInterface $builder, array $options)
//     {
//         $builder
//             ->add('email', 'text', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
//              ->add('username','text', array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
//             ->add('plainPassword', 'password', array(
//                 'label' => 'form.password',
               
//             ))

//              ->add('plainPassword', 'password', array(
//                 'label' => 'form.password.confirmation',
               
//             ))

//             ->add('plainPassword', 'password', array(
//                 'label' => 'form.password.confirmation',
               
//             ))
//             ->add('contactNo','text',array(
//                 'label'=>'联系电话',
//                 'translation_domain' => 'FOSUserBundle'))
//                     // ->add('country', 'choice', array(
//                     //     'label' => '国家', 
//                     //     'placeholder' => '--',
//                     //     'choices' => array('中国' => '中国', '新西兰' => '新西兰'),
//                     // ))
//                     // ->add('region','text',array('label'=>'省份/地区'))
//                     // ->add('city','text',array('label'=>'城市'))
//                     // ->add('post_code','text',array('label'=>'邮编'))
//                     // ->add('address','textarea',array('label'=>'详细地址'));
//         ;
//     }


//     public function get_parent() {
//         return 'AppBundle\Form\Type\RegistrationFormType';
//     }
//     public function configureOptions(OptionsResolver $resolver)
//     {
//         $resolver->setDefaults(array(
//             'data_class' => $this->class,
//             'csrf_token_id' => 'registration',
//             // BC for SF < 2.8
//             'intention'  => 'registration',
//         ));
//     }

//     // BC for SF < 2.7
//     public function setDefaultOptions(OptionsResolverInterface $resolver)
//     {
//         $this->configureOptions($resolver);
//     }
//     // BC for SF < 3.0
//     public function getName()
//     {
//         return $this->getBlockPrefix();
//     }
//     public function getBlockPrefix()
//     {
//         return 'AppBundle\Form\Type\RegistrationFormType';
//     }
// }