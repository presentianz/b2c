<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\User;
use AppBundle\Entity\UserInfo;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        //add a test user
        $user_test = new USER();
        $user_testInfo = new UserInfo();
        $user_test->setUsername('test');
        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($user_test);
        $user_test->setPassword($encoder->encodePassword('test', $user_test->getSalt()));
        $user_test->setEmail('test@caigou.co.nz');
        $user_test->setEnabled(true);
        $user_test->setRoles(array('ROLE_USER'));
        $user_test->setUserInfo($user_testInfo);
        $manager->persist($user_test);

        //add an admin user
        $user_admin = new USER();
        $user_adminInfo = new UserInfo();
        $user_admin->setUsername('admin');
        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($user_admin);
        $user_admin->setPassword($encoder->encodePassword('admin', $user_admin->getSalt()));
        $user_admin->setEmail('admin@caigou.co.nz');
        $user_admin->setEnabled(true);
        $user_admin->setRoles(array('ROLE_ADMIN'));
        $user_admin->setUserInfo($user_adminInfo);
        $manager->persist($user_admin);

        //update
        $manager->flush();
    }
}