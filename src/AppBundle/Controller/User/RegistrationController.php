<?php
    //src/AppBundle/Controller/User/RegistrationController.php
    /*
    用户注册Controller，已覆盖FOSUser/RegistrationController
    */
    namespace AppBundle\Controller\User;

    use FOS\UserBundle\FOSUserEvents;
    use FOS\UserBundle\Event\FormEvent;
    use FOS\UserBundle\Event\GetResponseUserEvent;
    use FOS\UserBundle\Event\FilterUserResponseEvent;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\RedirectResponse;
    use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
    use Symfony\Component\Security\Core\Exception\AccessDeniedException;
    use FOS\UserBundle\Model\UserInterface;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
    use AppBundle\Entity\User as User;
    use AppBundle\Entity\UserInfo;
    use Doctrine\ORM\Query\AST\Functions\DateAddFunction;
    use FOS\UserBundle\Controller\RegistrationController as BaseController;
    use FOS\UserBundle\FOSUserBundle;

    /**
     * @Route("/register")
     */
    class RegistrationController extends BaseController
    {
        /**
         * @Route("/", name="user_register")
         */
        public function registerAction(Request $request)
        {
            $formFactory = $this->get('fos_user.registration.form.factory');
            $userManager = $this->get('fos_user.user_manager');
            $dispatcher = $this->get('event_dispatcher');

            $user = $userManager->createUser();
            $user->setEnabled(true);
            $user->setRoles(array(User::ROLE_DEFAULT));

            $event = new GetResponseUserEvent($user, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

            if (null !== $event->getResponse()) {
                return $event->getResponse();
            }

            $form = $formFactory->createForm();
            $form->setData($user);

            $form->handleRequest($request);

            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                $user->setUserInfo(new UserInfo());//relate user & user_info
                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('fos_user_registration_confirmed');
                    $response = new RedirectResponse($url);
                }
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }

            //echo "已覆盖FOSUser注册Controller";

            return $this->render('FOSUserBundle:Registration:register.html.twig', array(
                'form' => $form->createView(),
            ));
        }

        //create user info record with default value in entity
        /*function createUserInfo(){
            $user_info = new UserInfo();
            //exit(\Doctrine\Common\Util\Debug::dump($user_info));

            //set default in the entity
            $em = $this->getDoctrine()->getManager();
            $em->persist($user_info);
            $em->flush();

            return $user_info;
        }*/
    }
