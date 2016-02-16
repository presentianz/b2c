<?php

    namespace AppBundle\Controller\Admin;

    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Doctrine\Common\Util\Debug;
    use AppBundle\Entity\ShipmentAddress;
    use AppBundle\Form\AddressType;
    use Symfony\Component\HttpFoundation\Response;

    /**
     * Address controller.
     *
     * @Route("/admin/address")
     */
    class AddressController extends Controller
    {
        /**
         * Lists all Address entities.
         *
         * @Route("", name="admin_address")
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
            $data = $em->getRepository('AppBundle:ShipmentAddress')->searchAddress($keys, $sort, $page, $item_no);


            return $this->render('Admin/Address/index.html.twig', array(
                'data' => $data,
            ));

        }
        /**
         * Creates a new Address entity.
         *
         * @Route("/", name="admin_address_create")
         * @Method("POST")
         */
        public function createAction(Request $request)
        {
            $entity = new Address();
            $form = $this->createCreateForm($entity);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('admin_address_show', array('id' => $entity->getId())));
            }
            return $this->render('Admin/Address/new.html.twig', array(
                'entity' => $entity,
                'form'   => $form->createView(),
            ));
        }

        /**
         * Creates a form to create a Address entity.
         *
         * @param Address $entity The entity
         *
         * @return \Symfony\Component\Form\Form The form
         */
        private function createCreateForm(Address $entity)
        {
            $form = $this->createForm(new AddressType(), $entity, array(
                'action' => $this->generateUrl('admin_address_create'),
                'method' => 'POST',
            ));

            $form->add('submit', 'submit', array('label' => 'Create'));

            return $form;
        }

        /**
         * Displays a form to create a new Address entity.
         *
         * @Route("/new", name="admin_address_new")
         * @Method("GET")
         */
        public function newAction()
        {
            $entity = new Address();
            $form   = $this->createCreateForm($entity);

            return $this->render('Admin/Address/new.html.twig', array(
                'entity' => $entity,
                'form'   => $form->createView(),
            ));
        }

        /**
         * Finds and displays a Address entity.
         *
         * @Route("/{id}", name="admin_address_show")
         * @Method("GET")
         */
        public function showAction($id)
        {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('AppBundle:Address')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Address entity.');
            }

            $deleteForm = $this->createDeleteForm($id);

            return $this->render('Admin/Address/show.html.twig', array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
            ));

        }

        /**
         * Displays a form to edit an existing Address entity.
         *
         * @Route("/{id}/edit", name="admin_address_edit")
         * @Method("GET")
         */
        public function editAction($id)
        {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('AppBundle:Address')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Address entity.');
            }

            $editForm = $this->createEditForm($entity);
            $deleteForm = $this->createDeleteForm($id);

            return $this->render('Admin/Address/edit.html.twig', array(
                'entity'      => $entity,
                'edit_form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
        }

        /**
         * Creates a form to edit a Address entity.
         *
         * @param Address $entity The entity
         *
         * @return \Symfony\Component\Form\Form The form
         */
        private function createEditForm(Address $entity)
        {
            $form = $this->createForm(new AddressType(), $entity, array(
                'action' => $this->generateUrl('admin_address_update', array('id' => $entity->getId())),
                'method' => 'PUT',
            ));

            $form->add('submit', 'submit', array('label' => 'Update'));

            return $form;
        }
        /**
         * Edits an existing Address entity.
         *
         * @Route("/{id}", name="admin_address_update")
         * @Method("PUT")
         */
        public function updateAction(Request $request, $id)
        {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('AppBundle:Address')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Address entity.');
            }

            $deleteForm = $this->createDeleteForm($id);
            $editForm = $this->createEditForm($entity);
            $editForm->handleRequest($request);

            if ($editForm->isValid()) {
                $em->flush();

                return $this->redirectToRoute('admin_address_show', array('id' => $id));
            }

            return $this->render('Admin/Address/edit.html.twig', array(
                'entity'      => $entity,
                'edit_form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
        }
        /**
         * Deletes a Address entity.
         *
         * @Route("/{id}", name="admin_address_delete")
         * @Method("DELETE")
         */
        public function deleteAction(Request $request, $id)
        {
            $form = $this->createDeleteForm($id);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $entity = $em->getRepository('AppBundle:Address')->find($id);

                if (!$entity) {
                    throw $this->createNotFoundException('Unable to find Address entity.');
                }

                $em->remove($entity);
                $em->flush();
            }

            return $this->redirect($this->generateUrl('admin_address'));
        }

        /**
         * Creates a form to delete a Address entity by id.
         *
         * @param mixed $id The entity id
         *
         * @return \Symfony\Component\Form\Form The form
         */
        private function createDeleteForm($id)
        {
            return $this->createFormBuilder()
                ->setAction($this->generateUrl('admin_address_delete', array('id' => $id)))
                ->setMethod('DELETE')
                ->add('submit', 'submit', array('label' => 'Delete'))
                ->getForm()
                ;
        }
    }
