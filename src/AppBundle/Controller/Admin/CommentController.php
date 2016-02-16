<?php

    namespace AppBundle\Controller\Admin;

    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Doctrine\Common\Util\Debug;
    use AppBundle\Entity\Comment;
    use AppBundle\Form\CommentType;
    use Symfony\Component\HttpFoundation\Response;

    /**
     * Comment controller.
     *
     * @Route("/admin/comment")
     */
    class CommentController extends Controller
    {
        /**
         * Lists all Comment entities.
         *
         * @Route("", name="admin_comment")
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
            $data = $em->getRepository('AppBundle:Comment')->searchComment($keys, $sort, $page, $item_no);


            return $this->render('Admin/Comment/index.html.twig', array(
                'data' => $data,
            ));

        }
        /**
         * Creates a new Comment entity.
         *
         * @Route("/", name="admin_comment_create")
         * @Method("POST")
         */
        public function createAction(Request $request)
        {
            $entity = new Comment();
            $form = $this->createCreateForm($entity);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('admin_comment_show', array('id' => $entity->getId())));
            }
            return $this->render('Admin/Comment/new.html.twig', array(
                'entity' => $entity,
                'form'   => $form->createView(),
            ));
        }

        /**
         * Creates a form to create a Comment entity.
         *
         * @param Comment $entity The entity
         *
         * @return \Symfony\Component\Form\Form The form
         */
        private function createCreateForm(Comment $entity)
        {
            $form = $this->createForm(new CommentType(), $entity, array(
                'action' => $this->generateUrl('admin_comment_create'),
                'method' => 'POST',
            ));

            $form->add('submit', 'submit', array('label' => 'Create'));

            return $form;
        }

        /**
         * Displays a form to create a new Comment entity.
         *
         * @Route("/new", name="admin_comment_new")
         * @Method("GET")
         */
        public function newAction()
        {
            $entity = new Comment();
            $form   = $this->createCreateForm($entity);

            return $this->render('Admin/Comment/new.html.twig', array(
                'entity' => $entity,
                'form'   => $form->createView(),
            ));
        }

        /**
         * Finds and displays a Comment entity.
         *
         * @Route("/{id}", name="admin_comment_show")
         * @Method("GET")
         */
        public function showAction($id)
        {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('AppBundle:Comment')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Comment entity.');
            }

            $deleteForm = $this->createDeleteForm($id);

            return $this->render('Admin/Comment/show.html.twig', array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
            ));

        }

        /**
         * Displays a form to edit an existing Comment entity.
         *
         * @Route("/{id}/edit", name="admin_comment_edit")
         * @Method("GET")
         */
        public function editAction($id)
        {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('AppBundle:Comment')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Comment entity.');
            }

            $editForm = $this->createEditForm($entity);
            $deleteForm = $this->createDeleteForm($id);

            return $this->render('Admin/Comment/edit.html.twig', array(
                'entity'      => $entity,
                'edit_form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
        }

        /**
         * Creates a form to edit a Comment entity.
         *
         * @param Comment $entity The entity
         *
         * @return \Symfony\Component\Form\Form The form
         */
        private function createEditForm(Comment $entity)
        {
            $form = $this->createForm(new CommentType(), $entity, array(
                'action' => $this->generateUrl('admin_comment_update', array('id' => $entity->getId())),
                'method' => 'PUT',
            ));

            $form->add('submit', 'submit', array('label' => 'Update'));

            return $form;
        }
        /**
         * Edits an existing Comment entity.
         *
         * @Route("/{id}", name="admin_comment_update")
         * @Method("PUT")
         */
        public function updateAction(Request $request, $id)
        {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('AppBundle:Comment')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Comment entity.');
            }

            $deleteForm = $this->createDeleteForm($id);
            $editForm = $this->createEditForm($entity);
            $editForm->handleRequest($request);

            if ($editForm->isValid()) {
                $em->flush();

                return $this->redirectToRoute('admin_comment_show', array('id' => $id));
            }

            return $this->render('Admin/Comment/edit.html.twig', array(
                'entity'      => $entity,
                'edit_form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
        }
        /**
         * Deletes a Comment entity.
         *
         * @Route("/{id}", name="admin_comment_delete")
         * @Method("DELETE")
         */
        public function deleteAction(Request $request, $id)
        {
            $form = $this->createDeleteForm($id);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $entity = $em->getRepository('AppBundle:Comment')->find($id);

                if (!$entity) {
                    throw $this->createNotFoundException('Unable to find Comment entity.');
                }

                $em->remove($entity);
                $em->flush();
            }

            return $this->redirect($this->generateUrl('admin_comment'));
        }

        /**
         * Creates a form to delete a Comment entity by id.
         *
         * @param mixed $id The entity id
         *
         * @return \Symfony\Component\Form\Form The form
         */
        private function createDeleteForm($id)
        {
            return $this->createFormBuilder()
                ->setAction($this->generateUrl('admin_comment_delete', array('id' => $id)))
                ->setMethod('DELETE')
                ->add('submit', 'submit', array('label' => 'Delete'))
                ->getForm()
                ;
        }
    }
