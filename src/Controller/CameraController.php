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
            $task = $form->getData();

            return $this->redirectToRoute('cameras');
        }


        return $this->render('camera/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/camera/{id}", name="camera_show")
     */
    public function show($id)
    {
        $camera = $this->getDoctrine()
            ->getRepository(Camera::class)
            ->find($id);

        if (!$camera) {
            throw $this->createNotFoundException(
                'No camera found for id '.$id
            );
        }

        return $this->render('camera/show.html.twig', ['camera' => $camera]);
    }
}


// $repository = $this->getDoctrine()->getRepository(Product::class);

// // look for a single Product by its primary key (usually "id")
// $product = $repository->find($id);

// // look for a single Product by name
// $product = $repository->findOneBy(['name' => 'Keyboard']);
// // or find by name and price
// $product = $repository->findOneBy([
//     'name' => 'Keyboard',
//     'price' => 1999,
// ]);

// // look for multiple Product objects matching the name, ordered by price
// $products = $repository->findBy(
//     ['name' => 'Keyboard'],
//     ['price' => 'ASC']
// );

// // look for *all* Product objects
//$products = $repository->findAll();
