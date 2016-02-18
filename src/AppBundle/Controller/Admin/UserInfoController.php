<?php

    namespace AppBundle\Controller\Admin;

    use AppBundle\Form\Type\UserInfoFormType;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Doctrine\Common\Util\Debug;
    use AppBundle\Entity\UserInfo;
    use Symfony\Component\HttpFoundation\Response;

    /**
     * UserInfo controller.
     *
     * @Route("/admin/user_info")
     */
    class UserInfoController extends Controller
    {
        /**
         * Lists all UserInfo entities.
         *
         * @Route("", name="admin_user_info")
         * @Method("GET")
         */
        public function indexAction(Request $request)
        {

            $keys = $request->query->get('keys');
            $sort = $request->query->get('sort');
            $page = $request->query->get('page');
            $item_no = $request->query->get('item_no');
            if (!(is_numeric($item_no) && $item_no > 1)) {
                $item_no = 20;
            }
            if(!$sort)
                $sort = 7;

            $em = $this->getDoctrine()->getManager();
            $data = $em->getRepository('AppBundle:UserInfo')->searchUserInfo($keys, $sort, $page, $item_no);


            return $this->render('Admin/UserInfo/index.html.twig', array(
                'data' => $data,
            ));

        }
        /**
         * Creates a new UserInfo entity.
         *
         * @Route("/", name="admin_user_info_create")
         * @Method("POST")
         */
        public function createAction(Request $request)
        {
            $entity = new UserInfo();
            $form = $this->createCreateForm($entity);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('admin_user_info_show', array('id' => $entity->getId())));
            }
            return $this->render('Admin/UserInfo/new.html.twig', array(
                'entity' => $entity,
                'form'   => $form->createView(),
            ));
        }

        /**
         * Creates a form to create a UserInfo entity.
         *
         * @param UserInfo $entity The entity
         *
         * @return \Symfony\Component\Form\Form The form
         */
        private function createCreateForm(UserInfo $entity)
        {
            $form = $this->createForm(new UserInfoFormType(), $entity, array(
                'action' => $this->generateUrl('admin_user_info_create'),
                'method' => 'POST',
            ));

            $form->add('submit', 'submit', array('label' => 'Create'));

            return $form;
        }

        /**
         * Displays a form to create a new UserInfo entity.
         *
         * @Route("/new", name="admin_user_info_new")
         * @Method("GET")
         */
        public function newAction()
        {
            $entity = new UserInfo();
            $form   = $this->createCreateForm($entity);

            return $this->render('Admin/UserInfo/new.html.twig', array(
                'entity' => $entity,
                'form'   => $form->createView(),
            ));
        }

        /**
         * Finds and displays a UserInfo entity.
         *
         * @Route("/{id}", name="admin_user_info_show")
         * @Method("GET")
         */
        public function showAction($id)
        {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('AppBundle:UserInfo')->find($id);
            //die(Debug::dump($entity));
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserInfo entity.');
            }

            $deleteForm = $this->createDeleteForm($id);

            return $this->render('Admin/UserInfo/show.html.twig', array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
            ));

        }

        /**
         * Displays a form to edit an existing UserInfo entity.
         *
         * @Route("/{id}/edit", name="admin_user_info_edit")
         * @Method("GET")
         */
        public function editAction($id)
        {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('AppBundle:UserInfo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserInfo entity.');
            }

            $editForm = $this->createEditForm($entity);
            $deleteForm = $this->createDeleteForm($id);

            return $this->render('Admin/UserInfo/edit.html.twig', array(
                'entity'      => $entity,
                'edit_form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
        }

        /**
         * Creates a form to edit a UserInfo entity.
         *
         * @param UserInfo $entity The entity
         *
         * @return \Symfony\Component\Form\Form The form
         */
        private function createEditForm(UserInfo $entity)
        {
            $form = $this->createForm(new UserInfoFormType(), $entity, array(
                'action' => $this->generateUrl('admin_user_info_update', array('id' => $entity->getId())),
                'method' => 'PUT',
            ));

            $form->add('submit', 'submit', array('label' => 'Update'));

            return $form;
        }
        /**
         * Edits an existing UserInfo entity.
         *
         * @Route("/{id}", name="admin_user_info_update")
         * @Method("PUT")
         */
        public function updateAction(Request $request, $id)
        {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('AppBundle:UserInfo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserInfo entity.');
            }

            $deleteForm = $this->createDeleteForm($id);
            $editForm = $this->createEditForm($entity);
            $editForm->handleRequest($request);

            if ($editForm->isValid()) {
                $em->flush();

                return $this->redirectToRoute('admin_user_info_show', array('id' => $id));
            }

            return $this->render('Admin/UserInfo/edit.html.twig', array(
                'entity'      => $entity,
                'edit_form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
        }
        /**
         * Deletes a UserInfo entity.
         *
         * @Route("/{id}", name="admin_user_info_delete")
         * @Method("DELETE")
         */
        public function deleteAction(Request $request, $id)
        {
            $form = $this->createDeleteForm($id);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $entity = $em->getRepository('AppBundle:UserInfo')->find($id);

                if (!$entity) {
                    throw $this->createNotFoundException('Unable to find UserInfo entity.');
                }

                $em->remove($entity);
                $em->flush();
            }

            return $this->redirect($this->generateUrl('admin_user_info'));
        }

        /**
         * Creates a form to delete a UserInfo entity by id.
         *
         * @param mixed $id The entity id
         *
         * @return \Symfony\Component\Form\Form The form
         */
        private function createDeleteForm($id)
        {
            return $this->createFormBuilder()
                ->setAction($this->generateUrl('admin_user_info_delete', array('id' => $id)))
                ->setMethod('DELETE')
                ->add('submit', 'submit', array('label' => 'Delete'))
                ->getForm()
                ;
        }
    }
