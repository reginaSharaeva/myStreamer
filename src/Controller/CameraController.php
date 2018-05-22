<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Camera;
use Symfony\Component\HttpFoundation\Response;

class CameraController extends Controller
{
    /**
     * @Route("/camera", name="cameras")
     */
    public function index()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        if ($user == "anon.") {
            return $this->redirect('/login');
        }

        $cameras = $this->getDoctrine()
            ->getRepository(Camera::class)
            ->findAll();

        return $this->render('camera/index.html.twig', ['cameras' => $cameras]);
    }

    /**
     * @Route("/camera/new", name="camera_new")
     */
    public function new(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        if ($user == "anon.") {
            return $this->redirect('/login');
        }

        $entityManager = $this->getDoctrine()->getManager();
        $camera = new Camera();

        $form = $this->createFormBuilder($camera)
            ->add('name', TextType::class)
            ->add('link', TextType::class)
            ->add('save', SubmitType::class, [
                'label' => 'Добавить',
                'attr' => ['class' => 'waves-effect waves-light btn'],
            ])
            ->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $camera = $form->getData();

            $entityManager->persist($camera);

            $entityManager->flush();

            return $this->redirectToRoute('cameras');
        }


        return $this->render('camera/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/camera/edit/{id}")
     */
    public function update(Request $request, $id)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        if ($user == "anon.") {
            return $this->redirect('/login');
        }

        $entityManager = $this->getDoctrine()->getManager();
        $camera = $entityManager->getRepository(Camera::class)->find($id);

        if (!$camera) {
            throw $this->createNotFoundException(
                'No camera found for id '.$id
            );
        }


        $form = $this->createFormBuilder($camera)
            ->add('name', TextType::class)
            ->add('link', TextType::class)
            ->add('save', SubmitType::class, [
                'label' => 'Сохранить',
                'attr' => ['class' => 'waves-effect waves-light btn'],
            ])
            ->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cameraUpd = $form->getData();

            $camera->setName($cameraUpd->getName());
            $camera->setLink($cameraUpd->getLink());

            $entityManager->flush();

            return $this->redirectToRoute('cameras');
        }


        return $this->render('camera/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/camera/delete/{id}")
     */
    public function delete(Request $request, $id)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        if ($user == "anon.") {
            return $this->redirect('/login');
        }

        $entityManager = $this->getDoctrine()->getManager();
        $camera = $entityManager->getRepository(Camera::class)->find($id);

        if (!$camera) {
            throw $this->createNotFoundException(
                'No camera found for id '.$id
            );
        }

        $entityManager->remove($camera);
        $entityManager->flush();

        return $this->redirectToRoute('cameras');
    }    
}