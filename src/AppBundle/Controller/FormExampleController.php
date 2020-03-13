<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FormExampleController extends Controller
{
    /**
     * @Route("/", name="form_add_example")
     */
    public function formAddExampleAction(Request $request)
    {
        $form = $this->createForm(ProductType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $product = $form->getData();
            $em->persist($product);
            $em->flush();

            $this->addFlash('success', 'We saved a product with id ' . $product->getID());
        }

        return $this->render('form-example\index.html.twig', [
            'form' => $form->createView()
        ]);
    }

//1. video
//    /**
//     * @Route("/", name="form_example")
//     */
//    public function formExampleAction(Request $request)
//    {
//        $form = $this->createFormBuilder()
//            ->add('personName', TextType::class)
//            ->add('submit', SubmitType::class, [
//                'label' => 'Submit Me Now!',
//                'attr' => [
//                    'class' => 'btn btn-success'
//                ]
//            ])
//            ->getForm();
//
//        $form->handleRequest($request);
//
//        if($form->isSubmitted() && $form->isValid()){
//            $name = $form->getData()['personName'];
//            $this->sendMail($name);
//        }
//
//        return $this->render('form-example\index.html.twig', [
//            'myForm' => $form->createView()
//        ]);
//    }
//
////Gmail esetén a setFrom nem működik!!!
//    private function sendMail($personName)
//    {
//        $mail = \Swift_Message::newInstance()
//            ->setSubject('test mail')
//            ->setFrom('teszt@pelda.hu')
//            ->setTo('figlerrenata85@gmail.com')
//            ->setBody($personName);
//        $this->get('mailer')->send($mail);
//    }
}
